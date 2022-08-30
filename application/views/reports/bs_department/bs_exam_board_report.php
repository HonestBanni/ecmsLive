        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">
                <?php echo $ReportName; ?> 
                 
                <hr>
            </h2>
            <div class="row cols-wrapper">
                      <div class="col-md-12">    
                       <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line"><?php echo $ReportName; ?> Search</span>
                        </h1>
                        <div class="section-content" >
                           
            
              <?php echo form_open('',array('class'=>'course-finder-form','name'=>'reportForm'));   ?>
                <div class="row">
                    <div class="col-md-3 col-sm-5">
                        <label for="name">Teacher name</label>
                         <input type="text" name="emp_id" class="form-control" placeholder="Teacher Name" id="EmpBsProgram">
                         <input type="hidden" name="emp_id" id="EmpBsProgram_id">
                         
                    </div>
                    <div class="col-md-3 col-sm-5">
                        <label for="name">Sections</label>
                        <input type="text" name="sec_id" class="form-control" placeholder="Section Name" id="SecBsProgram">
                        <input type="hidden" name="sec_id" id="SecBsProgram_id"> 
                    </div>
                    <div class="col-md-3 col-sm-5">
                        <label for="name">Subjects</label>
                            <input type="text" name="subject_id" class="form-control" placeholder="Subject Name" id="SubjBsProgram">
                            <input type="hidden" name="subject_id" id="SubjBsProgram_id"> 
                    </div>
                    <div class="col-md-2 col-sm-5">
                        <label for="name" style=" visibility: hidden">Subjectsqwqwqw</label>
                        <input type="button" id="Search" name="submit" value="Search" class="btn btn-theme">
                        <button type="button" class="btn btn-theme" style="float: right" id="print_bs_list"><i class="fa fa-print"></i> Print </button>
                    </div>
               </div>
                
              
                                       <?php
                                    echo form_close();
                                    ?>
                                </div>
                            
                                  
                                
                             
                             
                         </div><!--//section-content-->
                        
                        
                    </section>
          
                    </div>
               <div id="div_print">
                <div id="BsProgramResult">

                </div>
               </div>
        
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
   <div class="modal fade" id="viewTimeTable" tabindex="-1" role="dialog" aria-labelledby="viewTimeTable">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Time Table Details</h4>
      </div>
      <div class="modal-body">
          <div id="timetable_details_info">
              
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-theme" data-dismiss="modal">Close</button>
      
      </div>
    </div>
  </div>
</div>
        
        <script>
        
        jQuery(document).ready(function(){
            
            jQuery("#EmpBsProgram").autocomplete({  
                minLength: 0,
                source: "DropdownController/auto_emp_bs_programs/"+$("#EmpBsProgram").val(),
                autoFocus: true,
                scroll: true,
                dataType: 'jsonp',
                select: function(event, ui){
                jQuery("#EmpBsProgram").val(ui.item.contactPerson);
                jQuery("#EmpBsProgram_id").val(ui.item.emp_id);
                }
            }).focus(function() {  jQuery(this).autocomplete("search", "");  });
                
            jQuery("#SecBsProgram").autocomplete({  
                minLength: 0,
                source: "DropdownController/auto_sec_bs_programs/"+$("#SecBsProgram").val(),
                autoFocus: true,
                scroll: true,
                dataType: 'jsonp',
                select: function(event, ui){
                jQuery("#SecBsProgram").val(ui.item.contactPerson);
                jQuery("#SecBsProgram_id").val(ui.item.sec_id);
                }
            }).focus(function() {  jQuery(this).autocomplete("search", "");  });
                
            jQuery("#SubjBsProgram").autocomplete({  
                minLength: 0,
                source: "DropdownController/auto_subj_bs_programs/"+$("#SubjBsProgram").val(),
                autoFocus: true,
                scroll: true,
                dataType: 'jsonp',
                select: function(event, ui){
                jQuery("#SubjBsProgram").val(ui.item.contactPerson);
                jQuery("#SubjBsProgram_id").val(ui.item.sub_id);
                }
            }).focus(function() {  jQuery(this).autocomplete("search", "");  });
            
            
            jQuery('#Search').on('click',function(){
                jQuery('#BsProgramResult').val('');
                jQuery.ajax({
                    type:'post',
                    url : 'BsProgramSearch',
                    data:{
                        'TeacherId' : jQuery('#EmpBsProgram_id').val(),
                        'SectionId' : jQuery('#SecBsProgram_id').val(),
                        'SubjId'    : jQuery('#SubjBsProgram_id').val(),
                    },
                    success:function(result){
                       jQuery('#BsProgramResult').html(result);
                    }
                });
                
            });
            
           jQuery('.timetable_details').on('click',function(){
     
                var class_id = this.id;
                 jQuery.ajax({
                    type:'post',
                    url : 'TeacherSectionTimeTable',
                    data:{'class_id':class_id},
                    success:function(result){
                       jQuery('#timetable_details_info').html(result);
                    }
                });

            });
            
            $('#print_bs_list').on('click', function(){
                var TeacherId = jQuery('#EmpBsProgram_id').val();
                var SectionId = jQuery('#SecBsProgram_id').val();
                var SubjId    = jQuery('#SubjBsProgram_id').val();
                if(TeacherId == ''){ TeacherId = 0; }
                if(SectionId == ''){ SectionId = 0; }
                if(SubjId == ''){ SubjId = 0; }
                window.open('ReportsController/bs_exame_result_print/'+TeacherId+'/'+SectionId+'/'+SubjId, '_blank');
            });
            
        });
        
        </script>