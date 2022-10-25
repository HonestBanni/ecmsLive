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
    
     
    
 
    
   
   
   jQuery('#add_demo').on('click',function(){
      var feehead       = jQuery('#feehead').val();
      var hostel_amount = jQuery('#hostel_amount').val();
      var feed_id       = jQuery('#feehead_id').val();
      var formCode      = jQuery('#formCode').val();
      var type          = jQuery('#type').val();
      
      if(feed_id == ''){
          
          alert('Please Select Hostel head');
          jQuery('#feehead').focus();
          return false;
      }
      if(hostel_amount == ''){
          
          alert('Please Select Hostel Amount');
          jQuery('#hostel_amount').focus();
          return false;
      }
   var   data = {
          'feehead'         : feehead,
          'hostel_amount'   : hostel_amount,
          'formCode'        : formCode,
          'feed_id'         : feed_id,
          'type'            : type,
      };
              
       jQuery.ajax({
         type   :'post',
         url    :'addHostelHead',
         data   :data,
         success:function(result){
            jQuery('#show_result').html(result);
            jQuery('#hostel_amount').val('');
            jQuery('#feehead_id').val('');
            jQuery('#feehead').val('');
            jQuery('#type').val('');
         }
         
     });
   });

  
  jQuery('#print_challan').on('click',function(){
      
      var batch_id      = jQuery('#batch_id').val();
      var hostel_status = jQuery('#hostel_status').val();
      var instal_type   = jQuery('#instal_type').val();
      
      if(batch_id == ''){
          alert('Please Select Batch..');
          jQuery('#batch_id').focus();
          return false;
      }
      if(instal_type == ''){
          alert('Please Select Installment Type');
          jQuery('#instal_type').focus();
          return false;
      }
      
       window.open('hostelPrintChallanGroup/'+batch_id+'/'+instal_type+'/'+hostel_status, '_blank');
  });
  
  
 
   
});
