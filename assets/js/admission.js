jQuery(document).ready(function(){
 
   jQuery("#submitAc").on('click',function(){
       jQuery('#acdemicResult2').hide();
        var  student_id = jQuery('#student_id').val();
        var  sub_programId = jQuery('#sub_programId').val();
       if(sub_programId == '')
            {
               alert('Please select Prorgram name ');
               jQuery('#sub_pro_program').focus();
               return false;
            }
       
       var  rollno = jQuery('#rollno').val();
       if(rollno == '')
            {
               alert('Please select Roll No');
               jQuery('#rollno').focus();
               return false;
            }
       
       var  year_of_passing = jQuery('#year_of_passing').val();
       if(year_of_passing == '')
            {
               alert('Please Enter Passing Year');
               jQuery('#year_of_passing').focus();
               return false;
            }
       
       var  total_marks = jQuery('#total_marks').val();
       if(total_marks == '')
            {
               alert('Please Enter Total Marks');
               jQuery('#total_marks').focus();
               return false;
            }
       
       var  obtained_marks = jQuery('#obtained_marks').val();
       if(obtained_marks == '')
            {
               alert('Please Enter Obtained Marks');
               jQuery('#obtained_marks').focus();
               return false;
            }
       
       var  grade_id = jQuery('#grade_id').val();

       
     jQuery.ajax({
       type: "POST",
       url: "Admin/insertAcademic",
       data:  {
         'student_id': student_id,
         'sub_pro_id': sub_programId,
         'rollno': rollno,
         'year_of_passing': year_of_passing,
         'total_marks': total_marks,
         'obtained_marks': obtained_marks,
         'grade_id': grade_id
     },
       success: function(result)
       {
           
           
            jQuery('#sub_pro_program').val('');
            jQuery('#student_id').val('');
            jQuery('#sub_programId').val('');
            jQuery('#rollno').val('');
            jQuery('#year_of_passing').val('');
            jQuery('#total_marks').val('');
            jQuery('#obtained_marks').val('');
            jQuery('#grade_id').val('');
             
           jQuery('#acdemicResult').html(result);
       }
     });

  });
 
 
 
 var check;
$("#form_no_chk").on("click", function(){
    check = $("#mycheckbox").is(":checked");
    if(check) {
        jQuery('#form_noCheck').val('');
    } else {
        jQuery('#form_noCheck').val('1');
    }
}); 
    
jQuery("#addClass").on('click',function(){
       
    var  emp_id = jQuery('#EmployeeNameAutoId').val();
       if(emp_id == ''){
               alert('Please select Teacher');
               jQuery('#EmployeeNameWithSubjectAuto').focus();
               return false;
            }
    var  building_block = jQuery('#building_block').val();
//       if(building_block == ''){
//               alert('Please select Block');
//               jQuery('#building_block').focus();
//               return false;
//            }
    var  rooms = jQuery('#rooms').val();
//       if(rooms == ''){
//               alert('Please select Room');
//               jQuery('#rooms').focus();
//               return false;
//            }
    
    var  sec_id = jQuery('#sec_id').val();
       if(sec_id == '')
            {
               alert('Please select Section');
               jQuery('#sec').focus();
               return false;
            }
    
    var  subject_id = jQuery('#sub').val();
       if(subject_id == '')
            {
               alert('Please select Subject');
               jQuery('#sub').focus();
               return false;
            }
    
    var  day_id = jQuery('#day_id').val();
       if(day_id == '')
            {
               alert('Please select Day');
               jQuery('#day_id').focus();
               return false;
            }
    
    var  stime_id = jQuery('#stime_id').val();
       if(stime_id == '')
            {
               alert('Please select Starting Time');
               jQuery('#stime_id').focus();
               return false;
            }
    
    var  etime_id = jQuery('#etime_id').val();
       if(etime_id == '')
            {
               alert('Please select Ending Time');
               jQuery('#etime_id').focus();
               return false;
            }
    
    var  form_Code = jQuery('#form_Code').val();
     jQuery.ajax({
       type: "POST",
       url: "AttendanceController/add_timeTable",
       data:  {
         'day_id'           : day_id,
         'building_block'   : building_block,
         'rooms'            : rooms,
         'sec_id'           : sec_id,
         'emp_id'           : emp_id,
         'subject_id'       : subject_id,
         'stime_id'         : stime_id,
         'etime_id'         : etime_id,
         'form_Code'        : form_Code
     },
       success: function(result)
       {
            jQuery('#day_id').val('');                
            jQuery('#timeTable').html(result);
       }
     });

  });
    
jQuery("#addPractical").on('click',function(){
       
    var  emp_id = jQuery('#emp_id').val();
       if(emp_id == '')
            {
               alert('Please select Teacher');
               jQuery('#emp').focus();
               return false;
            }
    
    var  group_id = jQuery('#group_id').val();
       if(group_id == '')
            {
               alert('Please select Group');
               jQuery('#groupName').focus();
               return false;
            }
    
    var  subject_id = jQuery('#sub').val();
       if(subject_id == '')
            {
               alert('Please select Subject');
               jQuery('#sub').focus();
               return false;
            }
    
    var  day_id = jQuery('#day_id').val();
       if(day_id == '')
            {
               alert('Please select Day');
               jQuery('#day_id').focus();
               return false;
            }
    
    var  stime_id = jQuery('#stime_id').val();
       if(stime_id == '')
            {
               alert('Please select Starting Time');
               jQuery('#stime_id').focus();
               return false;
            }
    
    var  etime_id = jQuery('#etime_id').val();
       if(etime_id == '')
            {
               alert('Please select Ending Time');
               jQuery('#etime_id').focus();
               return false;
            }
    
    var  form_Code = jQuery('#form_Code').val();
     jQuery.ajax({
       type: "POST",
       url: "AttendanceController/add_Practical_timeTable",
       data:  {
         'day_id': day_id,
         'group_id': group_id,
         'emp_id': emp_id,
         'subject_id': subject_id,
         'stime_id': stime_id,
         'etime_id': etime_id,
         'form_Code': form_Code
     },
       success: function(result)
       {
            jQuery('#day_id').val('');                
            jQuery('#prac_timeTable').html(result);
       }
     });

  });     
 
 jQuery("#additem").on('click',function(){
        var  item_id = jQuery('#item_id').val();
       if(item_id == '')
            {
               alert('Please select Item');
               jQuery('#item_id').focus();
               return false;
            }
       
       var  brand_id = jQuery('#brand_id').val();
       
       var  price = jQuery('#price').val();
       if(price == '')
            {
               alert('Please Enter Price');
               jQuery('#price').focus();
               return false;
            }
       
       var  quantity = jQuery('#quantity').val();
       if(quantity == '')
            {
               alert('Please Enter Quantity');
               jQuery('#quantity').focus();
               return false;
            }
        var  form_Code = jQuery('#form_Code').val();
     jQuery.ajax({
       type: "POST",
       url: "InventoryController/add_purchase_order_item",
       data:  {
         'item_id': item_id,
         'brand_id': brand_id,
         'price': price,
         'quantity': quantity,
         'form_Code': form_Code
     },
       success: function(result)
       {
            jQuery('#item_id').val('');
            jQuery('#items').val('');
            jQuery('#brand_id').val('');
            jQuery('#brand').val('');
            jQuery('#price').val('');
            jQuery('#quantity').val('');                 
            jQuery('#purchaseOrder').html(result);
       }
     });

  });
    
jQuery("#additemissuance").on('click',function(){
    var  item_id = jQuery('#item_id').val();
       if(item_id == '')
            {
               alert('Please select Item');
               jQuery('#item_id').focus();
               return false;
            }
       
       var  quantity = jQuery('#quantity').val();
       if(quantity == '')
            {
               alert('Please Enter Quantity');
               jQuery('#quantity').focus();
               return false;
            }
        var  form_Code = jQuery('#form_Code').val();
     jQuery.ajax({
       type: "POST",
       url: "InventoryController/add_issuance_item",
       data:  {
         'item_id': item_id,
         'quantity': quantity,
         'form_Code': form_Code
     },
       success: function(result)
       {
            jQuery('#item_id').val('');
            jQuery('#items_category').val('');
            jQuery('#quantity').val('');                 
            jQuery('#itemsIssuance').html(result);
       }
     });

  });    
    
jQuery('#form_Check').on('change',function(){
     var formId     = jQuery('#form_Check').val();
     var batch_id   = jQuery('#batch_id').val();
  
     jQuery.ajax({
         type:'post',
         url : 'admin/form_no_Check',
         data:{'formId':formId,'batch_id':batch_id},
         success:function(result){
            if(result ==1){
                alert('Sorry This Form No. already exist');
                jQuery('#form_Check').val('');
                jQuery('#form_Check').focus();
                return false;
            }else{
            }
         }
         
     });
     
 });
    
 
jQuery('#checking_board_regno').on('change',function(){
     var board_regno = jQuery('#checking_board_regno').val();
     jQuery.ajax({
         type:'post',
         url : 'Admin/board_regno_Checking',
         data:{'board_regno':board_regno},
         success:function(result){
            if(result ==1){
                alert('Sorry ! This Board Registration Number already exist');
                jQuery('#checking_board_regno').val('');
                jQuery('#checking_board_regno').focus();
                return false;
            }else{
                
            }
         }
         
     });
     
 });
    
jQuery('#checking_college_no').on('change',function(){
     var college_no = jQuery('#checking_college_no').val();
     jQuery.ajax({
         type:'post',
         url : 'Admin/college_no_Checking',
         data:{'college_no':college_no},
         success:function(result){
            if(result ==1){
                alert('Sorry ! This College Number already exist');
                jQuery('#checking_college_no').val('');
                jQuery('#checking_college_no').focus();
                return false;
            }else{
                
            }
         }
         
     });
     
 });
    
jQuery('#uni_regno').on('change',function(){
     var college_no     = jQuery('#uni_regno').val();
     jQuery.ajax({
         type:'post',
         url : 'Admin/uni_regno_Checking',
         data:{'uni_regno':uni_regno},
         success:function(result){
            if(result ==1){
                alert('Record already exist');
                jQuery('#uni_regno').val('');
                jQuery('#uni_regno').focus();
                return false;
            }else{
                
            }
         }
         
     });
     
 });
    
   jQuery('#alumiProgrameId').on('change',function(){
    
     var programId = jQuery('#alumiProgrameId').val();
        
     jQuery.ajax({
         type   :'post',
         url    :'AdminDeptController/getSubProgram',
         data   :{'programId':programId},
        success :function(result){
            console.log(result);
           jQuery('#showAlumiSubPro').html(result);
        }
     });
 });
   jQuery('#alumiProgrameIdSearch').on('change',function(){
    
     var programId = jQuery('#alumiProgrameIdSearch').val();
 
     jQuery.ajax({
         type   :'post',
         url    :'AdminDeptController/getSubProgram',
         data   :{'programId':programId},
        success :function(result){
            console.log(result);
           jQuery('#showAlumiSubProSearch').html(result);
        }
     });
 });
    jQuery('#checkAll').click(function () {    
     jQuery('input:checkbox').prop('checked', this.checked);    
 });
  
    
jQuery("#occupation").autocomplete({
      
        minLength: 0,
        source: "AdminDeptController/auto_occupation/"+$("#occupation").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
        jQuery("#occupation").val(ui.item.contactPerson);
        jQuery("#occ_id").val(ui.item.occ_id);
        }
        }).focus(function() {  jQuery(this).autocomplete("search", "");  });
     
    
    jQuery("#empname").autocomplete({  
        minLength: 0,
        source: "AttendanceController/auto_empname/"+$("#empname").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
        jQuery("#empname").val(ui.item.contactPerson);
        jQuery("#emp_id").val(ui.item.id);
        }
        }).focus(function() {  jQuery(this).autocomplete("search", "");  });
    
    jQuery("#final_receive").autocomplete({  
        minLength: 0,
        source: "InventoryController/auto_emp_names/"+$("#final_receive").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
        jQuery("#final_receive").val(ui.item.contactPerson);
        jQuery("#final_received_by").val(ui.item.prepared_by);
        }
        }).focus(function() {  jQuery(this).autocomplete("search", "");  });
    
    jQuery("#emp").autocomplete({  
        minLength: 0,
        source: "AttendanceController/auto_emp/"+$("#emp").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
        jQuery("#emp").val(ui.item.contactPerson);
        jQuery("#emp_id").val(ui.item.emp_id);
        }
        }).focus(function() {  jQuery(this).autocomplete("search", "");  });
    
    jQuery("#employee_data").autocomplete({  
        minLength: 0,
        source: "AttendanceController/auto_employee/"+$("#employee_data").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
        jQuery("#employee_data").val(ui.item.contactPerson);
        jQuery("#emp_id").val(ui.item.emp_id);
        }
        }).focus(function() {  jQuery(this).autocomplete("search", "");  });
    
    jQuery("#sec_comulative").autocomplete({  
        minLength: 0,
        source: "AttendanceController/auto_section/"+$("#sec_comulative").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
        jQuery("#sec_comulative").val(ui.item.contactPerson);
        jQuery("#sec_id").val(ui.item.sec_id);
        }
        }).focus(function() {  jQuery(this).autocomplete("search", "");  });
    
    jQuery("#dept").autocomplete({  
        minLength: 0,
        source: "AttendanceController/auto_dept/"+$("#dept").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
        jQuery("#dept").val(ui.item.contactPerson);
        jQuery("#department_id").val(ui.item.department_id);
        }
        }).focus(function() {  jQuery(this).autocomplete("search", "");  });
    
    jQuery("#desg").autocomplete({  
        minLength: 0,
        source: "AttendanceController/auto_desg/"+$("#desg").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
        jQuery("#desg").val(ui.item.contactPerson);
        jQuery("#emp_desg_id").val(ui.item.emp_desg_id);
        }
        }).focus(function() {  jQuery(this).autocomplete("search", "");  });
    
    jQuery("#sec").autocomplete({  
        minLength: 0,
        source: "AttendanceController/auto_section/"+$("#sec").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
        jQuery("#sec").val(ui.item.contactPerson);
        jQuery("#sec_id").val(ui.item.sec_id);
        }
        }).focus(function() {  jQuery(this).autocomplete("search", "");  });
    jQuery("#sections_art_id").autocomplete({  
        minLength: 0,
        source: "AttendanceController/auto_section_arts/"+$("#sections_art_id").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
        jQuery("#sections_art_id").val(ui.item.contactPerson);
        jQuery("#sec_id").val(ui.item.sec_id);
        }
        }).focus(function() {  jQuery(this).autocomplete("search", "");  });
    
    jQuery("#sub").autocomplete({  
        minLength: 0,
        source: "AttendanceController/auto_sub/"+$("#sub").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
        jQuery("#sub").val(ui.item.contactPerson);
        jQuery("#subject_id").val(ui.item.subject_id);
        jQuery("#subject_flag").val(ui.item.flag);
        }
        }).focus(function() {  jQuery(this).autocomplete("search", "");  });
        
    jQuery("#domicile").autocomplete({  
        minLength: 0,
        source: "AdminDeptController/auto_domicile/"+$("#domicile").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
        jQuery("#domicile").val(ui.item.contactPerson);
        jQuery("#domicile_id").val(ui.item.domicile_id);
        }
        }).focus(function() {  jQuery(this).autocomplete("search", "");  });
    
    jQuery("#district").autocomplete({  
        minLength: 0,
        source: "AdminDeptController/auto_district/"+$("#district").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
        jQuery("#district").val(ui.item.contactPerson);
        jQuery("#district_id").val(ui.item.district_id);
        }
        }).focus(function() {  jQuery(this).autocomplete("search", "");  });
    
    jQuery("#bu").autocomplete({  
        minLength: 0,
        source: "AdminDeptController/auto_bu/"+$("#bu").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
        jQuery("#bu").val(ui.item.contactPerson);
        jQuery("#bu_id").val(ui.item.bu_id);
        }
        }).focus(function() {  jQuery(this).autocomplete("search", "");  });
    
    jQuery("#country").autocomplete({  
        minLength: 0,
        source: "AdminDeptController/auto_country/"+$("#country").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
        jQuery("#country").val(ui.item.contactPerson);
        jQuery("#country_id").val(ui.item.country_id);
        }
        }).focus(function() {  jQuery(this).autocomplete("search", "");  });
    
    jQuery("#degree").autocomplete({  
        minLength: 0,
        source: "AdminDeptController/auto_degree/"+$("#degree").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
        jQuery("#degree").val(ui.item.contactPerson);
        jQuery("#degree_id").val(ui.item.degree_id);
        }
        }).focus(function() {  jQuery(this).autocomplete("search", "");  
        });    
    
    jQuery("#program_Name").autocomplete({  
        minLength: 0,
        source: "AttendanceController/auto_program/"+$("#program_Name").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
        jQuery("#program_Name").val(ui.item.contactPerson);
        jQuery("#program_id").val(ui.item.code);
        }
        }).focus(function() {  jQuery(this).autocomplete("search", "");  });    

    jQuery("#sub_pro").autocomplete({  
        minLength: 0,
        source: "AttendanceController/auto_sub_program/"+$("#sub_pro").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
        jQuery("#sub_pro").val(ui.item.contactPerson);
        jQuery("#sub_proId").val(ui.item.code);
        }
        }).focus(function() {  jQuery(this).autocomplete("search", "");  });    

    
    
       jQuery('#sub_proId').on('change',function(){
        var subProId = jQuery('#sub_proId').val();
        
        jQuery.ajax({
            type:'post',
            url : 'Admin/get_session_name',
            data: {'subProId':subProId},
            success: function(result){
             jQuery('#showSession').html(result);
            }
        });
    });
    
    jQuery("#sub_pro_program").autocomplete({  
        minLength: 0,
        source: "AttendanceController/auto_sub_pro_program/"+$("#sub_pro_program").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
        jQuery("#sub_pro_program").val(ui.item.contactPerson);
        jQuery("#sub_programId").val(ui.item.code);
        }
        }).focus(function() {  jQuery(this).autocomplete("search", "");  });
    
    jQuery("#groupName").autocomplete({  
        minLength: 0,
        source: "AttendanceController/auto_practicalgroup/"+$("#groupName").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
        jQuery("#groupName").val(ui.item.contactPerson);
        jQuery("#group_id").val(ui.item.prcId);
        }
        }).focus(function() {  jQuery(this).autocomplete("search", "");  }); 
    
    jQuery("#subjects").autocomplete({  
        minLength: 0,
        source: "AttendanceController/auto_subjects/"+$("#subjects").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
        jQuery("#subjects").val(ui.item.contactPerson);
        jQuery("#subject_id").val(ui.item.subject_id);
        jQuery("#sub_pro_id").val(ui.item.sub_pro_id);  
        }
        }).focus(function() {  jQuery(this).autocomplete("search", "");  });
    
    jQuery("#sub_pro_programx").autocomplete({  
        
        minLength: 0,
        source: "AttendanceController/auto_sub_pro_program/"+$("#sub_pro_programx").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
        jQuery("#sub_pro_programx").val(ui.item.contactPerson);
        jQuery("#sub_pro_id").val(ui.item.code);
        }
        }).focus(function() {  jQuery(this).autocomplete("search", "");  });  
    
      jQuery("#emp_name").autocomplete({  
        minLength: 0,
        source: "AttendanceController/auto_emp_name/"+$("#emp_name").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
        jQuery("#emp_name").val(ui.item.contactPerson);
        jQuery("#prepared_by").val(ui.item.id);
        }
        }).focus(function() {  jQuery(this).autocomplete("search", "");  });
    
    jQuery("#emp_names").autocomplete({  
        minLength: 0,
        source: "InventoryController/auto_emp_names/"+$("#emp_names").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
        jQuery("#emp_names").val(ui.item.contactPerson);
        jQuery("#prepared_by").val(ui.item.prepared_by);
        }
        }).focus(function() {  jQuery(this).autocomplete("search", "");  });
    
    jQuery("#pemp_name").autocomplete({  
        minLength: 0,
        source: "AttendanceController/auto_pemp_name/"+$("#pemp_name").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
        jQuery("#pemp_name").val(ui.item.contactPerson);
        jQuery("#authorized_by").val(ui.item.authorized_by);
        }
        }).focus(function() {  jQuery(this).autocomplete("search", "");  });
    
    jQuery("#issuedto").autocomplete({  
        minLength: 0,
        source: "InventoryController/auto_issued_to/"+$("#issuedto").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
        jQuery("#issuedto").val(ui.item.contactPerson);
        jQuery("#issued_to").val(ui.item.id);
        }
        }).focus(function() {  jQuery(this).autocomplete("search", "");  });
    
    jQuery("#brand").autocomplete({  
        minLength: 0,
        source: "InventoryController/auto_brand/"+$("#brand").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
        jQuery("#brand").val(ui.item.contactPerson);
        jQuery("#brand_id").val(ui.item.id);
        }
        }).focus(function() {  jQuery(this).autocomplete("search", "");  });
    
    jQuery("#items").autocomplete({  
        minLength: 0,
        source: "InventoryController/auto_items/"+$("#items").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
        jQuery("#items").val(ui.item.contactPerson);
        jQuery("#item_id").val(ui.item.id);
        }
        }).focus(function() {  jQuery(this).autocomplete("search", "");  });
    
    jQuery("#items_category").autocomplete({  
        minLength: 0,
        source: "InventoryController/auto_items_category/"+$("#items_category").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
        jQuery("#items_category").val(ui.item.contactPerson);
        jQuery("#item_id").val(ui.item.id);
        jQuery("#item_quantity").val(ui.item.item_quantity);    
        }
        }).focus(function() {  jQuery(this).autocomplete("search", "");  });
 
// insert Academic Record 21-11-2016 start //    
    
  
    
  
//    var student_id= jQuery('#student_id').val();
//   jQuery.ajax({
//      type: "POST",
//       url: "Admin/insertAcademic123",
//       data: {'student_id':student_id},
//       success: function(result)
//       {
//           jQuery('#acdemicResult').html(result);
//       } 
//       
//   });
    
// insert Academic Record 21-11-2016 end //    
    
    jQuery("#quantity").keyup(function() {
    var item_quantity = jQuery("#item_quantity").val();
     if(item_quantity == 0)
     {
         alert("Sorry Item Quantity Not Available");
         jQuery("#quantity").val('');
     }
}); 
    
jQuery('#SProgrameId').on('change',function(){
    
     var programId = jQuery('#SProgrameId').val();
     jQuery.ajax({
         type   :'post',
         url    :'AdminDeptController/getSubProgram',
         data   :{'programId':programId},
        success :function(result){
            console.log(result);
           jQuery('#showingSubPro').html(result);
        }
     });
 });
    
jQuery('#lang_subpro_id').on('change',function(){
    
     var subproId = jQuery('#lang_subpro_id').val();
     jQuery.ajax({
         type   :'post',
         url    :'AdminDeptController/get_where_batch',
         data   :{'subproId':subproId},
        success :function(result){
            console.log(result);
           jQuery('#show_batch_id').html(result);
        }
     });
 });
    
jQuery('#lang_subpro_id').on('change',function(){
    
     var subproId = jQuery('#lang_subpro_id').val();
     jQuery.ajax({
         type   :'post',
         url    :'AdminDeptController/get_form_no',
         data   :{'subproId':subproId},
        success :function(result){
            console.log(result);
           jQuery('#form_no').html(result);
        }
     });
 });     
    
jQuery('#SProgrameId').on('change',function(){
    
     var programId = jQuery('#SProgrameId').val();
     jQuery.ajax({
         type   :'post',
         url    :'AdminDeptController/getBatch',
         data   :{'programId':programId},
        success :function(result){
            console.log(result);
           jQuery('#showingbatch_id').html(result);
        }
     });
 }); 
    
jQuery('#showingSubPro').on('change',function(){
    
    var sub_program_id= jQuery('#showingSubPro').val();
     jQuery.ajax({
         type   :'post',
         url    :'AdminDeptController/getSections',
         data   :{'sub_program_id':sub_program_id},
        success :function(result){
            console.log(result);
           jQuery('#showingSections').html(result);
        }
     });
 });   
    
jQuery('#showSubProo').on('change',function(){
    
    var sub_program_id= jQuery('#showSubProo').val();
     jQuery.ajax({
         type   :'post',
         url    :'AdminDeptController/getSections',
         data   :{'sub_program_id':sub_program_id},
        success :function(result){
            console.log(result);
           jQuery('#showSectionss').html(result);
        }
     });
 });  
    
jQuery("#add_student_rec").on('click',function(){
    var  student_id = jQuery('#student_id').val();
       if(student_id == '')
            {
               alert('Please select Student');
               jQuery('#student_id').focus();
               return false;
            } 
        var  form_Code = jQuery('#form_Code').val();
     jQuery.ajax({
       type: "POST",
       url: "admin/students_assign_group",
       data:  {
         'student_id': student_id,
         'form_Code': form_Code
     },
       success: function(result)
       {
            jQuery('#student_id').val('');          
            jQuery('#std_names_sec').val('');          
            jQuery('#studentRecord').html(result);
       }
     });

  }); 
    
    jQuery("#last_school").autocomplete({
      
        minLength: 0,
        source: "admin/last_school_auto/"+$("#last_school").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
            jQuery("#last_school").val(ui.item.value);
        }
        }).focus(function(){  
            jQuery(this).autocomplete("search", "");  
    });
  
//jQuery("#quantity").keyup(function() {
//    var item_quantity = jQuery("#item_quantity").val();
//    var quantity = jQuery("#quantity").val();
//     if(item_quantity < quantity)
//     {
//         alert("Sorry Item Quantity Greater Than Available Quantity");
//         jQuery("#quantity").val('');
//     }
//    
//});    
    
});
