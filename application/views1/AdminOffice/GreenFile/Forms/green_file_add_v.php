 
<!-- ******CONTENT****** --> 
<div class="content container">
    <h3 align="left"><?php echo $page_header; ?><hr></h3>
        <div class="row cols-wrapper">
            <div class="col-md-12">
                <form name="student" method="post" enctype="multipart/form-data" action="">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="usr">Board Regd No :</label>
                            <input type="text" name="board_regno"  class="form-control">
<!--                            <input type="text" name="board_regno"  class="form-control" id="checking_board_regno">-->
                        </div>
                        <div class="form-group col-md-4">
                            <label for="usr">University Reg No.:</label>
                            <input type="text" name="uni_regno" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="usr">College No.:</label>
                            <input type="text" name="college_no" class="form-control">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="usr">Student Name:<strong style="color:red; font-size: 14px;"> * </strong></label>
                              <input type="text" name="student_name"  class="form-control" required="required">        
                        </div>
                        <div class="form-group col-md-6">
                            <label for="usr">Father Name:<strong style="color:red; font-size: 14px;"> * </strong></label>
                            <input type="text" name="father_name"  class="form-control" required="required">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="usr">Occupation:</label>
                            <?php echo form_dropdown('occ_id', $occupation,'',  'class="form-control"'); ?>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="usr">Religion:</label>
                            <?php echo form_dropdown('religion_id', $religion,'',  'class="form-control"');?>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="usr">Domicile:</label>
                            <input type="text" name="domicile_id" placeholder="Domicile" class="form-control" id="domicile">
                            <input type="hidden" name="domicile_id" id="domicile_id">    
                        </div>
                        <div class="form-group col-md-4">
                            <label for="usr">Date of Birth <small>(DD-MM-YYYY)</small>:</label>
                            <input type="text" class="form-control date_format_d_m_yy" name="dob"> 
                        </div>
                        <div class="form-group col-md-4">
                            <label for="usr">Phone No 1.:</label>
                            <input type="text" class="form-control" name="mobile_no"> 
                        </div>
                        <div class="form-group col-md-4">
                            <label for="usr">Phone No 2:</label>
                            <input type="text" class="form-control" name="mobile_no2"> 
                        </div>
                        <div class="form-group col-md-12">
                            <label for="usr">Parmanent Address:</label>
                            <input type="text" class="form-control"  name="parmanent_address" id="parmanent_address"> 
                        </div>
                        <div class="form-group col-md-12">
                              <label for="usr">Postal Address:</label>
                          <input type="text" class="form-control"  name="app_postal_address"  id="app_postal_address"> 
                        </div>
                        <div class="form-group col-md-4">
                            <label for="usr">Sports:</label>
                            <?php echo form_dropdown('sports_id', $sports,'',  'class="form-control"');?>   
                        </div> 
                        <div class="form-group col-md-4">
                            <label for="usr">Guardian :</label>
                            <input type="text" class="form-control" name="guardian"> 
                        </div> 
                        <div class="form-group col-md-4">
                            <label for="usr">Student Type :</label>
                            <?php echo form_dropdown('studentType', $studentType,'',  'class="form-control"');   ?>
                        </div> 
                        <div class="form-group col-md-8">
                              <label for="usr">Previous Institute:</label>
                              <input type="text" class="form-control" name="std_inst_name" id="last_school"> 
                        </div>
                        <div class="form-group col-md-4">
                            <label for="usr">Exam Passed:</label>
                            <?php echo form_dropdown('std_degree_id', $degree,'',  'class="form-control"');?>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="usr">Admitted To the:</label>      
                            <?php  echo form_dropdown('std_admitted_to', $admitted,'',  'class="form-control" required="required"');  ?>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="usr">Year:</label>
                            <input type="text" class="form-control" placeholder="Year" name="std_year_of_passing" id="PassingYear"> 
                        </div>
                        <div class="form-group col-md-4">
                            <label for="usr">Roll No:</label>
                            <input type="text" class="form-control" name="std_rollno"> 
                        </div>
                        <div class="form-group col-md-4">
                            <label for="usr">Total Marks:</label>
                            <input type="text" class="form-control" name="std_total_marks"> 
                        </div>    
                        <div class="form-group col-md-4">
                            <label for="usr">Obtained Marks:</label>
                            <input type="text" class="form-control" name="std_obtained_marks"> 
                        </div>
                        <div class="form-group col-md-4">
                            <label for="usr">Grade:</label>
                            <?php echo form_dropdown('std_grade_id', $grade,'',  'class="form-control"');?>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="usr">Character:</label>
                             <?php echo form_dropdown('std_char_id', $character,'',  'class="form-control"');?>
                        </div>    
                        <div class="form-group col-md-3">
                            <label for="usr">Admission Date <small>(DD-MM-YYYY)</small>:</label>    
                            <input type="text" name="admission_date"  class="form-control date_format_d_m_yy"> 
                        </div>
                        <div class="form-group col-md-3">
                            <label for="usr">Certificate Issue Date <small>(DD-MM-YYYY)</small>:</label>
                            <input type="text" class="form-control date_format_d_m_yy"  name="certificate_issue_date" > 
                        </div>
                        <div class="form-group col-md-3">
                            <label for="usr">Dues if Any:</label>
                            <input type="number" class="form-control" name="dues_any"> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="usr">Remarks 1:</label>
                            <textarea type="text" class="form-control notes" rows="5" name="remarks"></textarea>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="usr">Remarks 2:</label>
                            <textarea type="text" class="form-control notes" rows="5" name="remarks2"></textarea> 
                        </div>
                    </div>
                    <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line"><?php echo $page_header?> Panel</span>
                        </h1>
                        <div class="section-content" >
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="name">Program</label>
                                    <div class="form-group ">
                                        <?php 
                                            echo form_dropdown('programe_id', $program,'',  'class="form-control " id="feeProgrameId"');
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="name">Sub Program</label>
                                     
                                    <div class="form-group ">
                                        <?php 
//                                        $sub_program = array('Sub Program'=>"Sub Program");
                                                echo form_dropdown('sub_programId', $sub_program,'',  'class="form-control sub_programId" id="showFeeSubPro"');
                                        ?>
                                    </div>
                                </div> 
                                <div class="col-md-3">
                                    <label for="name">Roll No</label>
                                    <div class="form-group ">
                                        <input type="text" id="rollno" placeholder="Roll No" class="form-control">
                                    </div>
                                </div> 
                                    <div class="col-md-3">
                                    <label for="name">Year Of Passing</label>
                                    <input type="text" class="form-control year_of_passing" placeholder="Year Of Passing" name="year_of_passing" id="PassingYearMore"> 
                                   
                                    
                                </div>
                                    
                                
                            </div>
                            <div class="row">
                                 <div class="col-md-3">
                                    <label for="name">Passing Institute</label>
                                    <input type="text" class="form-control" placeholder="Passing Institute" name="passing_institute" id="last_school_collge"> 
                                  
                                    
                                </div>
                                <div class="col-md-3">
                                    <label for="name">Total Marks</label>
                                    <?php 
                                     
                                            echo form_dropdown('total_marks', $totalMarks,550,  'class="form-control" id="total_marks"');
                                    ?>
                                    <input type="hidden" name="formCode" id="formCode" value="<?php $rand = rand(1,10000000); $date = date('YmdHis'); echo md5($rand.$date);?>">  
                                </div> 
                                <div class="col-md-3">
                                    <label for="name">Obtained Marks</label>
                                    <input type="number" id="obtained_marks" placeholder="Obtained Marks" class="form-control">
                                </div> 
                                <div class="form-group col-md-3">
                                        <label for="usr">Grade:</label>
                                        <?php
                                                echo form_dropdown('grade_id', $grade,'',  'class="form-control" id="grade_id"');
                                        ?>
                                </div>
                            </div>
                             
                              
                           </div><!--//section-content-->
                                     
                                 
                            <div style="padding-top:1%;">
                                <div class="col-md-4 pull-right">
                                    <button type="button" class="btn btn-theme" name="submitAc" id="GreenFileAdd"  value="Add Record" ><i class="fa fa-plus"></i>Add Record</button>
                                    <button type="submit" class="btn btn-theme" name="UpdateGreenFile" id="UpdateGreenFile"  value="UpdateGreenFile" ><i class="fa fa-book"></i>Update Green File</button>
                                    <!--<input type="submit" class="btn btn-theme" name="submit" value="Update Green File">-->
                                  </div>
                            </div>
                                    
                   </section>

          
            <div id="acdemicResult">
            </div>
    </form>            
                           
        </div>
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
<!--      <div class="modal fade" id="updateGreenFile" tabindex="-1" role="dialog" aria-labelledby="Update Green File">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Update Banner Details</h4>
      </div>
        
        <div id="show_greenfile_std_education">
            
        </div>
      
    </div>
  </div>
</div>   -->
        
        <script>
        jQuery(document).ready(function(){
            jQuery("#GreenFileAdd").on('click',function(){
               
//       jQuery('#acdemicResult2').hide();
        var  student_id = jQuery('#student_id').val();
        var  sub_programId = jQuery('.sub_programId').val();
       if(sub_programId == '')
            {
               alert('Please select Prorgram name ');
               jQuery('#sub_pro_program').focus();
               return false;
            }
       
       var  rollno = jQuery('#rollno').val();
//       
//       if(rollno == '')
//            {
//               alert('Please select Roll No');
//               jQuery('#rollno').focus();
//               return false;
//            }
       
       var  year_of_passing = jQuery('.year_of_passing').val();
//       if(year_of_passing == '')
//            {
//               alert('Please Enter Passing Year');
//               jQuery('.year_of_passing').focus();
//               return false;
//            }
       
       var  total_marks = parseInt(jQuery('#total_marks').val());
       if(total_marks == '')
            {
               alert('Please Enter Total Marks');
               jQuery('#total_marks').focus();
               return false;
            }
       
       var  obtained_marks = parseInt(jQuery('#obtained_marks').val());
       if(obtained_marks == null)
            {
               alert('Please Enter Obtained Marks');
               jQuery('#obtained_marks').focus();
               return false;
            }
       
       
       if(obtained_marks>total_marks){
           alert('Obtained Marks is Not Grater then Total Marks');
               jQuery('#obtained_marks').val('');
               jQuery('#obtained_marks').focus();
               return false;
       }
       
       if(obtained_marks<0){
           alert('Obtained Marks is Not Less then Zero');
               jQuery('#obtained_marks').val('');
               jQuery('#obtained_marks').focus();
               return false;
       }
       
       var  grade_id = jQuery('#grade_id').val();

       
     jQuery.ajax({
       type : "POST",
       url  : "GreenFileAddEdu",
       data :  {
         'student_id'       : student_id,
         'sub_pro_id'       : sub_programId,
         'rollno'           : rollno,
         'year_of_passing'  : year_of_passing,
         'total_marks'      : total_marks,
         'obtained_marks'   : obtained_marks,
         'grade_id'         : grade_id,
         'formCode'         : jQuery('#formCode').val(),
         'college_ed'       : jQuery('#last_school_collge').val()
     },
       success: function(result){
                jQuery('#rollno').val('');
                jQuery('.sub_programId').val('');
                jQuery('#year_of_passing').val('');
                jQuery('#total_marks').val('');
                jQuery('#obtained_marks').val('');
                jQuery('#grade_id').val('');
                jQuery('.year_of_passing').val('');
                
                jQuery.ajax({
                    type     : "POST",
                    url      : "GreenFileShowEduAdd",
                    data     :  {'formCode'   : jQuery('#formCode').val()},
                    success  : function(result){
                    jQuery('#acdemicResult').html(result);
                    }
                  });
           
       }
     });

  });
           
//
//    jQuery.ajax({
//       type     : "POST",
//       url      : "GreenFileShowEduAdd",
//       data     :  {'student_id'   : jQuery('#formCode').val()},
//       success  : function(result){
////           alert('test');
//        jQuery('#acdemicResult').html(result);
//       }
//     });
     
     jQuery('#parmanent_address').keyup(function(){
        jQuery('#app_postal_address').val(jQuery('#parmanent_address').val());
     });
     
     
    jQuery("#PassingYear").autocomplete({  
        minLength: 0,
        source: "DropdownController/passing_year/"+$("#PassingYear").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
        jQuery("#PassingYear").val(ui.item.contactPerson);
       
        }
    }).focus(function() {  jQuery(this).autocomplete("search", "");  });
    
    jQuery("#PassingYearMore").autocomplete({  
        minLength: 0,
        source: "DropdownController/passing_year/"+$("#PassingYear").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
        jQuery("#PassingYear").val(ui.item.contactPerson);
       
        }
    }).focus(function() {  jQuery(this).autocomplete("search", "");  });
     
     
     
          jQuery("#last_school_collge").autocomplete({
      
        minLength: 0,
        source: "admin/last_school_auto/"+$("#last_school_collge").val(),
        autoFocus: true,
        scroll: true,
        dataType: 'jsonp',
        select: function(event, ui){
            jQuery("#last_school_collge").val(ui.item.value);
        }
        }).focus(function(){  
            jQuery(this).autocomplete("search", "");  
    });
     
     
     });
        
        </script>     