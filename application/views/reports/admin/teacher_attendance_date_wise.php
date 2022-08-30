
<script language="javascript">
  function printdiv(printpage)
  {
    var headstr = "<html><head><title></title></head><body>";
//    var headstr = "<html><head><title></title></head><body><p><img  class='img-responsive' src='assets/images/logo.png' alt='Edwardes College Peshawar'></p>";
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
               <!-- ******BANNER****** -->
            
            <div class="page-wrapper">
                            <header class="page-heading clearfix">
                                <h1 class="heading-title pull-left"><?php echo $ReportName?>
                                </h1>
                                <div class="breadcrumbs pull-right">
                                  <ul class="breadcrumbs-list">
                                    <li class="breadcrumbs-label">You are here:
                                    </li>
                                    <li> 
                                      <?php echo anchor('admin/admin_home', 'Home');?> 
                                      <i class="fa fa-angle-right">
                                      </i>
                                    </li>
                                    <li class="current"><?php echo $ReportName?>
                                    </li>
                                  </ul>
                                </div>
                    <!--//breadcrumbs-->
                  </header> 
                 <div class="col-md-12">    
                       <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                              <span class="line"><?php echo  $ReportName?> Panel</span>
                        </h1>
                        <div class="section-content">
                                <div class="row">
                                    <form class="course-finder-form" name="reportForm" method="post" accept-charset="utf-8">
                                      <div class="col-md-4">
                                          <label for="name">Teacher Name ( Designation , Subject )</label>
                                             <?php
                                                 echo form_input(array(
                                                     'name'          => 'emp_id_report',
                                                     'id'            => 'EmployeeNameWithSubjectAuto',
                                                     'class'         => 'form-control',
                                                     'placeholder'   => 'Employee name',
                                                     'type'          => 'text',
                                                     'required'      => 'required'
                                                     ));
                                                 echo form_input(array(
                                                     'name'          => 'emp_idCode_report',
                                                     'id'            => 'EmployeeNameAutoId',
                                                     'class'         => 'form-control',
                                                     'type'          => 'hidden'
                                                 ));  
                                             ?>
                                       </div> 
                                      <div class="col-md-3">
                                          <label for="name">Date From</label>
                                             <?php
                                                 echo form_input(array(
                                                     'name'          => 'date_from',
                                                     'id'          => 'date_from',
                                                     'class'         => 'form-control datepicker ',
                                                     'placeholder'   => 'Date From',
                                                     'type'          => 'text',
                                                     'value'         => date('d-m-Y'),
                                                     'required'      => 'required'
                                                     ));

                                             ?>
                                       </div> 
                                      <div class="col-md-3">
                                          <label for="name">Date To</label>
                                             <?php
                                                 echo form_input(array(
                                                     'name'          => 'date_to',
                                                     'id'          => 'date_to',
                                                     'class'         => 'form-control datepicker ',
                                                     'placeholder'   => 'Date To',
                                                     'type'          => 'text',
                                                     'required'      => 'required',
                                                     'value'         => date('d-m-Y')
                                                     ));

                                             ?>
                                       </div>
                                        <label for="name" style="visibility: hidden">Date Fsdfsdfdsfdsrom</label>
                                        <button type="button" name="searchDateWise" value="searchDateWise" id="searchDateWise" class="btn btn-theme"><i class="fa fa-search"></i> Search </button>
                                        <button type="button" name="print" value="print" onclick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print</button>
                                    </form>
                                </div>
                       </div><!--//section-content-->
                        
                        
                    </section>
          
                    </div>  
                
                  <div id="div_print">
                <div class="col-md-12">
                    <div id="TeacherRecord">
                        
                    </div>
                    </div>
                    
                    
                    
                    
                   
                    
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
<script>
    jQuery(document).ready(function(){
       
        jQuery('#searchDateWise').on('click',function(){
            var employee_id     = jQuery('#EmployeeNameAutoId').val();
            var employee_name   = jQuery('#EmployeeNameWithSubjectAuto').val();
             if(employee_id == ''){
                    alert('Please Select Employee..');
                    return false;
                    jQuery('#EmployeeNameWithSubjectAuto').focus();
                }
            var date_from       = jQuery('#date_from').val();
            var date_to         = jQuery('#date_to').val();
            var data            = {'emp_id':employee_id,'date_from':date_from,'date_to':date_to,'emp_name':employee_name}
            
            $.ajax({
                    url     : 'ReportsController/teacher_attendance_date_wise_report_result',
                    type    : 'post',
                    data    :  data,
                    success  : function(response){
                      jQuery('#TeacherRecord').html(response); 
                    }
                });
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
 
  <style>
      .datepicker{
          z-index: 1;
      }
  </style>     
</script>

