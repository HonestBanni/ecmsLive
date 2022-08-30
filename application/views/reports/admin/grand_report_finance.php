<script language="javascript">
function printdiv(printpage)
{
var headstr = "<html><head><title></title></head><body><p><img  class='img-responsive' src='assets/images/logo.png' alt='Edwardes College Peshawar'></p>";
var footstr = "</body>";
var newstr = document.all.item(printpage).innerHTML;
var oldstr = document.body.innerHTML;
document.body.innerHTML = headstr+newstr+footstr;
window.print();
document.body.innerHTML = oldstr;
return false;
}
</script>
<!-- ******CONTENT****** --> 
<div class="content container">
  <div class="page-wrapper">
      <section class="course-finder" style="padding-bottom: 2%;">
                <h1 class="section-heading text-highlight">
                            <span class="line"><?php if(@$ReportName): echo $ReportName;endif;?></span>
                        </h1>
          <form method="post" action="ReportsController/fee_students_search">
                         <div class="col-md-12">
                        <div class="col-md-3">
                            <label for="name">College No</label>
                            <input type="text" name="college_no"  placeholder="College No." class="form-control college_no">
                        </div>
                        <div class="col-md-3">
                            <label for="name">Student Name</label>
                            <input type="text" name="student_name"   placeholder="Student Name" class="form-control student_name">
                        </div>
                        <div class="col-md-3">
                            <label for="name">Father Name</label>
                            <input type="text" name="father_name"   placeholder="Father Name" class="form-control father_name">
                        </div>
                        <div class="col-md-3">
                            <label for="name">Gender</label>
                                <?php 
                                    echo form_dropdown('gender', $gender,'',  'class="form-control gender" id="gender"');
                                ?>
                        </div>
                         <div class="col-md-3">
                            <label for="name">Select Shift</label>
                                 
                                    <?php
                                         echo form_dropdown('shift', $shift,'',  'class="form-control" id="shift"');
                                    ?>
                               
                            </div>     
                        <div class="col-md-3">
                            <label for="name">Program</label>
                                <?php 
                                    echo form_dropdown('programe_id', $program,'',  'class="form-control programe_id" id="feeProgrameId"');
                                ?>
                        </div>
                        
                        <div class="col-md-3">
                            <label for="name">Sub Program</label>
                                <?php 
                                $sub_program = array(''=>"Sub Program");
                                        echo form_dropdown('sub_pro_id', $sub_program,'',  'class="form-control sub_pro_id"  id="showFeeSubPro"');
                                ?>
                        </div>
                        <div class="col-md-3">
                            <label for="name">Batch</label>
                                <?php
                                    $batch = array(''=>"Batch");
                                    echo form_dropdown('batch_id', $batch,'',  'class="form-control batch_id" id="batch_id"');
                                ?>
                        </div>     
                        <div class="col-md-3">
                            <label for="name">Section</label>
                                <?php 
                                $Section = array(''=>"Section");
                                        echo form_dropdown('section', $Section,'',  'class="form-control section"  id="showSections"');
                                ?>
                        </div>
                        <div class="col-md-3">
                            <label for="name">Student Status</label>
                                <?php
                                    echo form_dropdown('s_status_id', $student_status,'',  'class="form-control s_status_id" ');

                                ?>
                        </div>
                        <div class="col-md-3">
                            <label for="name">Admission Date From</label>
                            <input type="text" id="admission_date_from" name="date_from"  placeholder="Admission From" class="form-control datepicker">
                        </div>
                        <div class="col-md-3">
                            <label for="name">Admission Date To</label>
                            <input type="text" name="date_to" id="admission_date_to"  placeholder="Admission To" class="form-control datepicker" value="<?php echo date('d-m-Y')?>">
                        </div>
                        </div>
                         
                                <div class="col-md-3 pull-right">
                                    <label for="name" style=" visibility: hidden ">Admission Dsdsdsdsdsate To</label>
                                    <input type="button" name="search" class="btn btn-theme" value="Search" id="search_std">
                                    <button type="submit" name="Excel" class="btn btn-theme" value="Excel" id="Excel"><i class="fa fa-book"></i> Excel</button>
                                    <button type="button" name="print" value="print"  onClick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print </button> 
                            
     
                                </div>
                        
               </form>
                </div>   
          
          </section>
    <div class="page-content">
      <div class="row">
        <article class="contact-form col-md-12 col-sm-7  page-row">                               
            <div id="div_print">
        <div id="show_all_std">
             
                
            </div>     
        </div>        
           
            </article>
          <!--//contact-form-->
          </div>
        <!--//page-row-->
      </div>
      <!--//page-content-->
    </div>
    <!--//page-wrapper--> 
  </div>
  <!--//content-->
 
 <script>
jQuery('#search_std').on('click',function(){
    
    var data = {
        'college_no'    : jQuery('.college_no').val(),
        'gender'        : jQuery('.gender').val(),
        'student_name'  : jQuery('.student_name').val(),
        'programe_id'   : jQuery('.programe_id').val(),
        'sub_pro_id'    : jQuery('.sub_pro_id').val(),
        'section'       : jQuery('.section').val(),
        'batch_id'      : jQuery('.batch_id').val(),
        's_status_id'   : jQuery('.s_status_id').val(),
        'date_from'     : jQuery('#admission_date_from').val(),
        'date_to'       : jQuery('#admission_date_to').val(),
        'shift'         : jQuery('#shift').val(),
        'Search'         : 'Search',
        };
        
       jQuery.ajax({
         type       :'post',
         url        :'ReportsController/fee_students_search',
         async      : false,
         dataType   : 'json',
         data       :data,
         success :function(result){
            var totalCount = result.length;
            var html = '';
               
               html += '<h3 align="center">Grand Report Finance</h3>';
               html += '<h4>Result '+totalCount+'</h4>';
               html += '<tr></tr><table class="table table-boxed table-bordered table-striped" id="table" style="font-size:11px">'+
                        '<thead>'+
                          '<tr>'+
                              '<th>#</th>'+
                              '<th>Form</th>'+
                              '<th>College#</th>'+
                              '<th>Student Name</th>'+
                              '<th>Father Name</th>'+
                              '<th>Gender</th>'+
                              '<th>Shift</th>'+
                              '<th>Batch Name</th>'+
                              '<th>Sub Program</th>'+
                              '<th>Section</th>'+
                              '<th>O/T . Marks</th>'+
                              '<th>%age</th>'+
                              '<th>Adm Date</th>'+
                              '<th>Status</th>'+
                          '</tr>';
            var i;
             var sn = 1;
             for(i=0; i<result.length; i++ ){
                 
                 html += '<tr>'+
                        '<td>'+sn+'</td>'+
                        '<td>'+result[i].form_no+'</td>'+
                        '<td>'+result[i].college_no+'</td>'+
                        '<td>'+result[i].student_name+'</td>'+
                        '<td>'+result[i].father_name+'</td>'+
                        '<td>'+result[i].genderName+'</td>'+
                        '<td>'+result[i].shiftName+'</td>'+
                        '<td>'+result[i].batch_name+'</td>'+
                        '<td>'+result[i].subprogram+'</td>'+
                        '<td>'+result[i].sectionName+'</td>'+
                        '<td>'+result[i].obtained_marks+'/'+result[i].total_marks+'</td>'+
                        '<td>'+result[i].percentage+'</td>'+
                        
                        '<td>'+result[i].admission_date+'</td>'+
                        '<td>'+result[i].student_status+'</td>'+
                  '</tr>';
                    sn++;
             } 
             jQuery('#show_all_std').html(html); 
        },error: function(){
                alert('Could not get Data from Database');
        }
     });
     
 });
 
   $(function() {
            $('.datepicker').datepicker( {
               changeMonth: true,
                changeYear: true,
                 dateFormat: 'dd-mm-yy'
           
            });
        });
 
</script>