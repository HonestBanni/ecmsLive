<style>

.report_header{
    display: none !important;
}
 
</style>

<script language="javascript">
  function printdiv(printpage)
  {
//    var headstr = "<html><head><title></title></head><body>";
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
        <header class="page-heading clearfix">
            <h1 class="heading-title pull-left"><?php echo $page_header?></h1>
                <div class="breadcrumbs pull-right">
                    <ul class="breadcrumbs-list">
                        <li class="breadcrumbs-label">You are here:</li>
                        <li><?php echo anchor('admin/admin_home', 'Home');?> 
                          <i class="fa fa-angle-right">
                          </i>
                        </li>
                        <li class="current"><?php echo $page_header?></li>
                    </ul>
                </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
     <div class="row">
          <div class="col-md-12">
              <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line"><?php echo $page_header?> Panel</span>
                        </h1>
                        <div class="section-content" >
                           <?php echo form_open('',array('class'=>'course-finder','id'=>'DefaulterMessage'));
                                  
                                     ?>
                                <div class="row">
                                 
                                <div class="col-md-2 col-sm-5">
                                          <label for="name">College #</label>
                                         
                                                <?php
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'collegeNo',
                                                                'type'          => 'number',
                                                                'class'         => 'form-control',
                                                                'placeholder'   => 'College #',
                                                                 )
                                                             );
                                            ?>
                                     </div>
                                <div class="col-md-2 col-sm-5">
                                      <label for="name">Name</label>

                                            <?php
                                                echo  form_input(
                                                         array(
                                                            'name'          => 'stdName',
                                                            'type'          => 'text',
                                                            'class'         => 'form-control',
                                                            'placeholder'   => 'Student Name',
                                                             )
                                                         );
                                                  ?>
                                    </div>
                                <div class="col-md-2 col-sm-5">
                                          <label for="name">Father Name</label>
                                                <?php
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'fatherName',
                                                                'type'          => 'text',
                                                                'class'         => 'form-control',
                                                                'placeholder'   => 'Father Name',
                                                                 )
                                                             );
                                                      ?>
                                             
                                            
                                     </div>
                                 
                                 
                                <div class="col-md-2">
                                <label for="name">Stage</label>
                                    <?php  echo form_dropdown('stage_id', $stage_id,'',  'class="form-control" id="stage_id"');?>
                                </div>
                                <div class="col-md-2">
                                <label for="name">Program</label>
                                    <?php  echo form_dropdown('programe_id', $program,'',  'class="form-control programe_id" id="feeProgrameId"'); ?>
                                </div>
                                    <div class="col-md-2">
                                        <label for="name">Sub Program</label> 
                                        <?php  echo form_dropdown('sub_pro_id', $sub_program,'',  'class="form-control sub_pro_id" id="showFeeSubPro"'); ?>
                                    
                                    </div>
                                    <div class="col-md-2">
                                    <label for="name">Batch</label>
                                        <?php echo form_dropdown('batch_id', $batch_name,'','class="form-control  " id="batch_id"');?>
                                    </div>
                                    <div class="col-md-2">
                                    <label for="name">Section</label>
                                        <?php echo form_dropdown('section', $section,'',  'class="form-control section" id="showSections"');?>
                                    </div> 
                                    <div class="col-md-2">
                                        <label for="name">Student Status</label>
                                            <?php  echo form_dropdown('std_status', $student_status,'',  'class="form-control" '); ?>
                                    </div>
                                    <div class="col-md-2 col-sm-5">
                                          <label for="name">Date From Send</label>
                                         
                                                <?php
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'date_from',
                                                                'class'         => 'form-control date_format_d_m_yy',
                                                                'id'            => 'date_from',
                                                                ));
                                            ?>
                                     </div>
                                    <div class="col-md-2 col-sm-5">
                                          <label for="name">Date To Send</label>
                                         
                                                <?php
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'date_to',
                                                                'class'         => 'form-control date_format_d_m_yy',
                                                                'readonly'      => 'readonly',
                                                                'id'            => 'date_to',
                                                                'value'         => date('d-m-Y'),
                                                                ));
                                            ?>
                                     </div>
                             </div>
                              
                           </div><!--//section-content-->
                                     
                                 
                          <div style="padding-top:1%;">
                                <div class="col-md-3 pull-right">
                                    <button type="button" class="btn btn-theme" name="filterSearch" id="filterSearch"  value="filterSearch" ><i class="fa fa-search"></i> Search</button>
                                    <button type="button" name="print" value="print" onclick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print</button>    
                                </div>
                            </div>
                                    <?php
                                    echo form_close();
                                    ?>
                     </section>
              <div id="search_grid">
                  
              </div>
                                  
            </div>
 
          </div>
          
      
      </div>
                 </div>
                
    
      
        <!--//page-row-->
      </div>
 
    <!--//page-wrapper--> 
 
   
    <script type="text/javascript">
        jQuery(document).ready(function(){
            jQuery('#filterSearch').on('click',function(){
                   var formData = new FormData($("#DefaulterMessage")[0]);
                   formData.set("date_from", jQuery('#date_from').val());
                   formData.set("date_to", jQuery('#date_to').val());
                   formData.set("request", 'SearchReport');
                    $.ajax({
                        type     : "POST",
                        url      : 'Fee-Message-Report-Grid',
                        data     : formData,
//                        dataType : 'json',
                        contentType : false,
                        processData : false,
                        success  : function(response){
                           $('#search_grid').html(response);
                             
                            console.log(response);  
                        }
                    });
                   
               });
        });
    </script>
 
     
  
 
    
    
    