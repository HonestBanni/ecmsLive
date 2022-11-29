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
               
                     
                     
                    <form method="post">
                         <div class="col-md-12">
                         
                              
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
                                    echo form_dropdown('batch', $batch,'',  'class="form-control batch_id" id="batch_id"');
                                ?>
                        </div>     
                        <div class="col-md-3">
                            <label for="name">Student Status</label>
                                <?php
                                    echo form_dropdown('application_status', $student_status,'5',  'class="form-control s_status_id" ');

                                ?>
                        </div>
                        <div class="col-md-3">
                            <label for="name">Gender</label>
                                <?php
                                    echo form_dropdown('gender', $gender,'',  'class="form-control gender_id" ');

                                ?>
                        </div>
                          <div class="col-md-3 pull-right">
                                    <label style="visibility: hidden" for="name">Student Status sdsdsdsdsdsd</label>
                                    <input type="button" name="search" class="btn btn-theme" value="Search" id="search_std">
                                    <button type="button" name="print" value="print"  onClick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print </button> 
                            
     
                                </div>
                         
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
        'gender_id'     : jQuery('.gender_id').val(),
        'date_to'       : jQuery('#admission_date_to').val(),
        'shift'         : jQuery('#shift').val(),
        };
        
       jQuery.ajax({
         type       :'post',
         url        :'ReportsController/student_shit_wise_report_search',
         async      : false,
         dataType   : 'json',
         data       :data,
         success :function(result){
            var totalCount = result.length;
            var html = '';
                html += '<h3 align="center">Student Shift Wise Report</h3>';
                html += '<tr></tr><table class="table table-boxed table-bordered table-striped" id="table">'+
                        '<thead>'+
                          '<tr>'+
                              '<th>Program</th>'+
                              '<th>Morning 1 </th>'+
                              '<th>Morning 2</th>'+
                              '<th>Total</th>'+
                          '</tr>';
                var i;
                var sn = 1;
             for(i=0; i<result.length; i++ ){
                 html += '<tr>'+
                        '<td>'+result[i].Program+'</td>'+
                        '<td>'+result[i].Morning_one+'</td>'+
                        '<td>'+result[i].Morning_two+'</td>'+
                        '<td>'+result[i].Total+'</td>'+
                        
                  '</tr>';
                    sn++;
             } 
             jQuery('#show_all_std').html(html); 
        },error: function(){
                alert('Could not get Data from Database');
        }
     });
     
 });

 
</script>