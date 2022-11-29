
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
                                      <div class="col-md-3">
                                          <label for="name">Year</label>
                                             <?php
                                                $dateObj   = DateTime::createFromFormat('!Y', date('Y'));
                                                $yearName   = $dateObj->format('Y'); // March
                                            echo form_dropdown('Year',$year,$yearName,array('class'=>'form-control','id'=>'Year'));  ?>
                                       </div> 
                                      <div class="col-md-3">
                                          <label for="name">Month</label>
                                             <?php
                                                $dateObjm   = DateTime::createFromFormat('!m', date('m'));
                                                $monthName  = $dateObjm->format('m'); // March
                                             echo form_dropdown('Month',$months,$monthName,array('class'=>'form-control','id'=>'Month'));  ?>
                                       </div> 
                                       
                                         <div class="col-md-4">
                                        <label for="name" style="visibility: hidden">Date Fsdfsdfdsfsdfsdf dfdsrom sdfsdfsdfsdf</label>
                                        <button type="button" name="searchMonthWise" value="searchMonthWise" id="searchMonthWise" class="btn btn-theme"><i class="fa fa-search"></i> Search </button>
                                        <button type="submit" name="ExportMonthWise" value="ExportMonthWise" id="ExportMonthWise" class="btn btn-theme"><i class="fa fa-download"></i> Excel </button>
                                        <button type="button" name="loading" value="loading" id="loading" class="btn btn-theme"> Please wait...</button>
                                        <button type="button" name="print" value="print" id="print" onclick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print</button>
                                         </div>
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
        jQuery('#loading').hide();
        jQuery('#print').hide();
        jQuery('#searchMonthWise').on('click',function(){
            var Year       = jQuery('#Year').val();
            var Month      = jQuery('#Month').val();
            var data       = {'Year':Year,'Month':Month}
            jQuery('#searchMonthWise').hide();
            jQuery('#ExportMonthWise').hide();
            jQuery('#print').hide();
             jQuery('#loading').show();
            $.ajax({
                    url     : 'ReportsController/teacher_attendance_month_wise_report_result',
                    type    : 'post',
                    data    :  data,
                    success  : function(response){
                      jQuery('#TeacherRecord').html(response); 
                       jQuery('#searchMonthWise').show();
                       jQuery('#ExportMonthWise').show();
                       jQuery('#print').show();
                       jQuery('#loading').hide();
                    }
                });
            });
            
         jQuery("#ExportMonthWise").on('click',function(){
                jQuery('#loading').show();
                jQuery('#print').hide();
                jQuery('#searchMonthWise').hide();
           
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

