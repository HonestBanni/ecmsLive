jQuery(document).ready(function(){
  
    jQuery('#asst_name').focusout(function(){
        var bb_id       = jQuery('#bb_id').val();
        var asst_name  = jQuery('#asst_name').val();
        if(bb_id === ''){
            alert('Select Block');
            jQuery('#bb_id').focus();
            return false;
        }
     
        
        jQuery.ajax({
            type   : 'post',
            url    : 'checkAssetName',
            data   : {'bb_id':bb_id,'asst_name':asst_name},
            success: function(result){
                if(result==1){
                    alert('Name already Exist');
                     jQuery('#asst_name').val('');
                     jQuery('#asst_name').focus();
                    return false;
                }
            }
        });
    });
    
    jQuery('#bb_shortname').on('change',function(){
     var bb_shortname     = jQuery('#bb_shortname').val();
  
     jQuery.ajax({
         type:'post',
         url : 'InventoryController/bb_shortname',
         data:{'bb_shortname':bb_shortname},
         success:function(result){
            if(result ==1){
                alert('Sorry This Block Short Name already exist');
                jQuery('#bb_shortname').val('');
                jQuery('#bb_shortname').focus();
                return false;
            }else{
            }
         }
         
     });
     
 });
    
jQuery('#rm_shortname').on('change',function(){
     var rm_shortname     = jQuery('#rm_shortname').val();
  
     jQuery.ajax({
         type:'post',
         url : 'InventoryController/rm_shortname',
         data:{'rm_shortname':rm_shortname},
         success:function(result){
            if(result ==1){
                alert('Sorry This Room Short Name already exist');
                jQuery('#rm_shortname').val('');
                jQuery('#rm_shortname').focus();
                return false;
            }else{
            }
         }
         
     });
     
 }); 
    
     jQuery("#room").autocomplete({  
    minLength: 0,
    source: "InventoryController/auto_rooms/"+$("#room").val(),
    autoFocus: true,
    scroll: true,
    dataType: 'jsonp',
    select: function(event, ui){
    jQuery("#room").val(ui.item.contactPerson);
    jQuery("#rm_id").val(ui.item.id);
    }
    }).focus(function() {  jQuery(this).autocomplete("search", "");  });
    
    jQuery("#block").autocomplete({  
    minLength: 0,
    source: "InventoryController/auto_blocks/"+$("#block").val(),
    autoFocus: true,
    scroll: true,
    dataType: 'jsonp',
    select: function(event, ui){
    jQuery("#block").val(ui.item.contactPerson);
    jQuery("#bb_id").val(ui.item.id);
    }
    }).focus(function() {  jQuery(this).autocomplete("search", "");  });
    
    jQuery("#work_order").on('click',function(){
    var  item_name = jQuery('#item_name').val();
       if(item_name == '')
            {
               alert('Please Mention Item Name');
               jQuery('#item_name').focus();
               return false;
            }
       
       var  price = jQuery('#price').val();
       if(price == '')
            {
               alert('Please Enter Price');
               jQuery('#price').focus();
               return false;
            }
       
       var  quantity = jQuery('#quantity').val();
       var  days = jQuery('#days').val();
        var  form_Code = jQuery('#form_Code').val();
     jQuery.ajax({
       type: "POST",
       url: "InventoryController/add_work_order_item",
       data:  {
         'item_name': item_name,
         'price': price,
         'quantity': quantity,
         'days': days,
         'form_Code': form_Code
     },
       success: function(result)
       {
            jQuery('#item_name').val('');
            jQuery('#price').val('');
            jQuery('#quantity').val('');                 
            jQuery('#days').val('');                 
            jQuery('#purchaseOrder').html(result);
       }
     });

  });
   
   jQuery('#item_name').focusout(function(){
       var cat_id        = jQuery('#cat_id').val();
       var asst_type_id  = jQuery('#asst_type_id').val();
       var item_name     = jQuery('#item_name').val();
       
       jQuery.ajax({
            type   : 'post',
            url    : 'checkItemName',
            data   : {'cat_id':cat_id,'asst_type_id':asst_type_id,'item_name':item_name},
            success: function(result){
              
                if(result==1){
//                    alert('Name already Exist');
//                     jQuery('#item_name').val('');
//                     jQuery('#item_name').focus();
//                    return false;
                }
            }
        });
   });  
   jQuery('#srtnameId').focusout(function(){
     
       var item_name      = jQuery('#srtnameId').val();
       
       jQuery.ajax({
            type   : 'post',
            url    : 'checkItemSrtCode',
            data   : {'item_name':item_name},
            success: function(result){
              
                if(result==1){
                //    alert('Name already Exist');
                 //    jQuery('#srtnameId').val('');
                //     jQuery('#srtnameId').focus();
                  //  return false;
                }
            }
        });
   });  
    
   jQuery('#srtname').focusout(function(){
       var srtname        = jQuery('#srtname').val();
     
       jQuery.ajax({
            type   : 'post',
            url    : 'checkItemCode',
            data   : {'srtname':srtname},
            success: function(result){
              if(result==1){
                    alert('Name already Exist');
                     jQuery('#srtname').val('');
                     jQuery('#srtname').focus();
                    return false;
                }
            }
        });
   });  
   
    jQuery("#emp_id").autocomplete({
      
        minLength: 0,
        source: "autocompleteFixEmp/"+$("#emp_id").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
            jQuery("#emp_idCode").val(ui.item.code);
 
        }
        }).focus(function(){  
            jQuery(this).autocomplete("search", "");  
    });
    jQuery("#blockName").autocomplete({
      
        minLength: 0,
        source: "autocompleteFixBlock/"+$("#blockName").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
            jQuery("#blockNameId").val(ui.item.code);
 
        }
        }).focus(function(){  
            jQuery(this).autocomplete("search", "");  
    });

    jQuery("#itemname").autocomplete({
      
        minLength: 0,
        source: "autocompleteItems/"+$("#itemname").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
            jQuery("#itemnameCode").val(ui.item.code);
            
               var item_id =jQuery("#itemnameCode").val();
            
            jQuery.ajax({
            type   : 'post',
            url    : 'itemGRNdate',
            data   : {'item_list':item_id},
            success: function(result){
                
                jQuery('#grn_id').html(result);
               
            }
        });
 
        }
        }).focus(function(){  
            jQuery(this).autocomplete("search", "");  
    });

    jQuery("#roomname").autocomplete({
      
        minLength: 0,
        source: "autocompleteRoom/"+$("#roomname").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
            jQuery("#roomnameCode").val(ui.item.code);
 
        }
        }).focus(function(){  
            jQuery(this).autocomplete("search", "");  
    });
   
   
   jQuery('#saveIssues').hide();
   
   
//      jQuery('#updateInvt').on('click',function(){
//       
//       var emp_idCode   = jQuery('#emp_idCode').val();
//       var itemnameCode = jQuery('#itemnameCode').val();
//       var roomnameCode = jQuery('#roomnameCode').val();
//       var quantity     = jQuery('#quantity').val();
//       var issuedate    = jQuery('#issuedate').val();
//       var item_p_price = jQuery('#item_p_price').val();
//       var item_p_date  = jQuery('#item_p_date').val();
//       var formCode     = jQuery('#formCode').val();
//       
//       var itemname     = jQuery('#itemname').val();
//       if(itemname ==''){
//           alert('Please select Item name');
//           jQuery('#itemname').focus();
//           return false;
//       }
//       
//       var roomname     = jQuery('#roomname').val();
//       if(roomname==''){
//           alert('Please select Room');
//           jQuery('#roomname').focus();
//           return false;
//       }
//       
//       var data = {
//           'emp_idCode'     :emp_idCode,
//           'itemnameCode'   :itemnameCode,
//           'roomnameCode'   :roomnameCode,
//           'quantity'       :quantity,
//           'formCode'       :formCode,
//           'purchasePrice'  :item_p_price,
//           'purchaseDate'   :item_p_date,
//           'issuedate'      :issuedate
//       }
//      
//        jQuery.ajax({
//            type   : 'post',
//            url    : 'saveQuantityDemo',
//            data   : data,
//            success: function(result){
//                jQuery('#saveIssues').show();
//                jQuery('#itemname').val('');
//                jQuery('#roomname').val('');
//                jQuery('#quantity').val('');
//                jQuery('#item_p_price').val('');
//            
//                jQuery('#showFixItemRecord').html(result);
//               
//            }
//        });
//       
//   });
     jQuery('#updateInvt').on('click',function(){
       
       var emp_idCode   = jQuery('#emp_idCode').val();
       var itemnameCode = jQuery('#itemnameCode').val();
       var serialNo     = jQuery('#serialNo').val();
       var depttnameCode = jQuery('#depttnameCode').val();
       var roomnameCode = jQuery('#roomnameCode').val();
       var quantity     = jQuery('#quantity').val();
       var issuedate    = jQuery('#issuedate').val();
       var item_p_price = jQuery('#item_p_price').val();
       var item_p_date  = jQuery('#item_p_date').val();
       var grn_id       = jQuery("#grn_id").val();
       var manualGRN    = jQuery("#manualGRN").val();
       var formCode     = jQuery('#formCode').val();
       var comments     = jQuery('#comments').val();

       var itemname     = jQuery('#itemname').val();
       if(emp_idCode ==''){
           alert('Please select Employee');
           jQuery('#emp_id').focus();
           return false;
       }
       if(itemnameCode ==''){
           alert('Please select Item name');
           jQuery('#itemNameCons').focus();
           return false;
       }
       if(grn_id ==''){
           alert('Please Select GRN');
           jQuery('#grn_id').focus();
           return false;
       }
       if(quantity ==''){
           alert('Please Enter Quantity..');
           jQuery('#quantity').focus();
           return false;
       }
       
       var roomname     = jQuery('#roomname').val();
       if(roomname==''){
           alert('Please select Room');
           jQuery('#roomname').focus();
           return false;
       }
       
       var data = {
           'emp_idCode111'  : emp_idCode,
           'itemnameCode'   : itemnameCode,
           'depttname'      : depttnameCode,
           'serial_no'      : serialNo,
           'manual_grn'     : manualGRN,
           'grn_items'      : grn_id,
           'roomnameCode'   : roomnameCode,
           'quantity'       : quantity,
           'formCode'       : formCode,
           'purchasePrice'  : item_p_price,
           'purchaseDate'   : item_p_date,
           'issuedate'      : issuedate,
           'comments'       : comments,
           
       };
      
        jQuery.ajax({
            type   : 'post',
            url    : 'saveQuantityDemo',
            data   : data,
            success: function(result){
                jQuery('#saveIssues').show();
                jQuery('#itemNameCons').val('');
                jQuery('#roomname').val('');
                jQuery('#quantity').val('');
                jQuery('#item_p_price').val('');
                jQuery('#item_grn').val('');
                jQuery('#depttnameCode').val('');
                jQuery('#serialNo').val('');
                jQuery('#manualGRN').val('');
            
                jQuery('#showFixItemRecord').html(result);
               
            }
        });
       
   });
   
   
   //Save All Items 
   jQuery('#saveIssues').on('click',function(){
      
       var emp_idCode   = jQuery('#emp_idCode').val();
       var issuedate    = jQuery('#issuedate').val();
       var formCode    = jQuery('#formCode').val();
       
       if(emp_idCode == ''){
           alert('Please select Employee..');
           jQuery('#emp_id').focus();
           return false; 
       }
       
       var data = {
           'emp_idCode' :emp_idCode,
           'issuedate'  :issuedate,
           'formCode'   :formCode
       };
       
        jQuery.ajax({
            type   : 'post',
            url    : 'saveQuantity',
            data   : data,
            success: function(result){
               alert('Record save Successfully');  
             window.location.reload(); 
            
               
            }
        });
       
   });

//    jQuery('.deleteFixedItems').on('click',function(){
//       var id = this.id;
//       
//        jQuery.ajax({
//            type   : 'post',
//            url    : 'udpateFixedItems/'+id ,
//            success: function(result){
//                var del = id+'ItemRow';
//                jQuery('#'+del).hide(); 
//               
//            }
//        });
//       
//       
//    });
    
    jQuery('#emp_name').keyup(function(){
        
        var empname = jQuery('#emp_name').val();
        var data = {
            'empname':empname
        };
         jQuery.ajax({
            type   : 'post',
            url    : 'inventoryResult',
            data   : data,
            success: function(result){
              
              jQuery('#inventoryReport').html(result);
               
            }
        });
        
        
    });
    
    jQuery('#search').on('click',function(){
        var emp         = jQuery('#emp_id').val();
        var blockName   = jQuery('#blockName').val();
        var itemname    = jQuery('#itemname').val();
        var roomname    = jQuery('#roomname').val();
        
        if(emp ===''){
           jQuery('#emp_idCode').val(''); 
        }
        if(blockName ===''){
           jQuery('#blockNameId').val(''); 
        }
        if(itemname==''){
           jQuery('#itemnameCode').val(''); 
        }
        
        if(roomname==''){
           jQuery('#roomnameCode').val(''); 
        }
        
        jQuery.ajax({
            type   : 'post',
            url    : 'inventorySearch',
            data   : jQuery('form').serialize(),
            success: function(result){
              
              jQuery('#reportResult').html(result);
               
            }
        });
      
    });
    jQuery('#deptsearch').on('click',function(){
        var emp         = jQuery('#emp_id').val();
        var blockName   = jQuery('#blockName').val();
        var itemname    = jQuery('#itemname').val();
        var roomname    = jQuery('#roomname').val();
        
        if(emp ==''){
           jQuery('#emp_idCode').val(''); 
        }
        if(blockName==''){
           jQuery('#blockNameId').val(''); 
        }
        if(itemname==''){
           jQuery('#itemnameCode').val(''); 
        }
        
        if(roomname==''){
           jQuery('#roomnameCode').val(''); 
        }
        
        jQuery.ajax({
            type   : 'post',
            url    : 'inventoryDeptSearch',
            data   : jQuery('form').serialize(),
            success: function(result){
              
              jQuery('#reportResult').html(result);
               
            }
        });
      
    });
    
     jQuery('#searchBarcode').on('click',function(){
   
        var emp         = jQuery('#emp_id').val();
        var blockName   = jQuery('#blockName').val();
        var itemname    = jQuery('#itemname').val();
        var roomname    = jQuery('#roomname').val();
        var fromdate    = jQuery('#fromdate').val();
        var todate      = jQuery('#todate').val();
        
        if(fromdate==''){
           jQuery('#fromdate').focus();
           alert('Please Select From Date');
           return false;
        }
        if(todate==''){
           jQuery('#todate').focus();
           alert('Please Select To Date');
           return false;
        }
        
         if(emp==''){
           jQuery('#emp_idCode').val('') 
        }
        if(blockName==''){
           jQuery('#blockNameId').val('') 
        }
        if(itemname==''){
           jQuery('#itemnameCode').val('') 
        }
        
        if(roomname==''){
           jQuery('#roomnameCode').val('') 
        }
        
        jQuery.ajax({
            type   : 'post',
            url    : 'inventoryBarcode',
            data   : jQuery('form').serialize(),
            success: function(result){
              
              jQuery('#reportResultBarcode').html(result);
               
            }
        });
        
     
    });
    
    
    jQuery('#purchasePrice').on('change',function(){
        
    });
     jQuery('#dept_rate').on('change',function(){
        var dep_rate        = jQuery(this).val();
        var purchasePrice   = jQuery('#purchasePrice').val();
        var dep_amount      = (purchasePrice*dep_rate)/100;
        
         jQuery('#dept_amount').val(dep_amount);
          
         
         
         var PurchaseDate =  jQuery('#PurchaseDate').val();
//          
          
  
//          alert(newDate);
//           alert(calcDate(today,past));
          
        var today = new Date();
        var past = new Date(PurchaseDate); 
        var years = calcDate(today,past);
        var accum_depr = dep_amount*years;
        jQuery('#accum_depr').val(accum_depr);
        jQuery('#wdv').val(purchasePrice-accum_depr);
       
       
        function calcDate(date1,date2) {
            var diff = Math.floor(date1.getTime() - date2.getTime());
            var day = 1000 * 60 * 60 * 24;
            var days = Math.floor(diff/day);
            var months = Math.floor(days/31);
            var years = Math.floor(months/12);

//    var message = date2.toDateString();
//    message += " was ";
//    message += days + " days " ;
//    message += months + " months ";
            var  message = years;

    return message;
    }
   
   
          
          
          
     });
     
//    jQuery("#supplier").autocomplete({
//      
//        minLength: 0,
//        source: "autocompleteSupplier/"+$("#supplier").val(),
//        autoFocus: true,
//        scroll: true,
//        dataType: 'jsonp',
//        select: function(event, ui){
//            jQuery("#supplierId").val(ui.item.code);
// 
//        }
//        }).focus(function(){  
//            jQuery(this).autocomplete("search", "");  
//    });

jQuery('#searchDetails').on('click',function(){
        var emp         = jQuery('#emp_id').val();
        var blockName   = jQuery('#blockName').val();
        var itemname    = jQuery('#itemname').val();
        var roomname    = jQuery('#roomname').val();
        
        if(emp ===''){
           jQuery('#emp_idCode').val(''); 
        }
        if(blockName ===''){
           jQuery('#blockNameId').val(''); 
        }
        if(itemname==''){
           jQuery('#itemnameCode').val(''); 
        }
        
        if(roomname==''){
           jQuery('#roomnameCode').val(''); 
        }
        
        jQuery.ajax({
            type   : 'post',
            url    : 'inventorySearchDetails',
            data   : jQuery('form').serialize(),
            success: function(result){
              
              jQuery('#reportResult').html(result);
               
            }
        });
      
    });

   jQuery('#search_total').on('click',function(){
         
        var emp         = jQuery('#emp_id').val();
        var blockName   = jQuery('#blockName').val();
        var itemname    = jQuery('#itemname').val();
        var roomname    = jQuery('#roomname').val();
        
        if(emp ===''){
           jQuery('#emp_idCode').val(''); 
        }
        if(blockName ===''){
           jQuery('#blockNameId').val(''); 
        }
        if(itemname==''){
           jQuery('#itemnameCode').val(''); 
        }
        
        if(roomname==''){
           jQuery('#roomnameCode').val(''); 
        }
        
        jQuery.ajax({
            type   : 'post',
            url    : 'inventorySearchAll',
            data   : jQuery('form').serialize(),
            success: function(result){
              
              jQuery('#reportResult_all').html(result);
               
            }
        });
      
    });
    
    
    jQuery('#searchEdit').on('click',function(){
        var emp         = jQuery('#emp_id').val();
        var blockName   = jQuery('#blockName').val();
        var itemname    = jQuery('#itemname').val();
        var roomname    = jQuery('#roomname').val();
        
        if(emp ===''){
           jQuery('#emp_idCode').val(''); 
        }
        if(blockName ===''){
           jQuery('#blockNameId').val(''); 
        }
        if(itemname==''){
           jQuery('#itemnameCode').val(''); 
        }
        
        if(roomname==''){
           jQuery('#roomnameCode').val(''); 
        }
        
        jQuery.ajax({
            type   : 'post',
            url    : 'fixedItemSearchEdit',
            data   : jQuery('form').serialize(),
            success: function(result){
              
              jQuery('#reportResult').html(result);
               
            }
        });
      
    });


 });

