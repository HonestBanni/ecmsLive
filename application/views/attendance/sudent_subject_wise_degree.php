
<!-- ******CONTENT****** --> 
<div class="content container">
  <div class="page-wrapper">
    <header class="page-heading clearfix">
      <h1 class="heading-title pull-left"><?php echo $HeaderPage?> 
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
          <li class="current"><?php echo $HeaderPage?>
        </ul>
      </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
      <div class="row">
        <section class="course-finder" style="padding-bottom: 2%;">
            <h1 class="section-heading text-highlight">
                <span class="line"><?php echo $HeaderPage?> Search</span>
            </h1>
                <div class="section-content" >
                    <div class="row">
                        <?php echo form_open('',array('class'=>'form-inline course-finder-form','name'=>'reportForm'));   ?>
                            <div class="col-md-12">
                                <div class="form-group ">   
                                    <?php
                                    
                                  
                                    echo form_input(array(
                                            'name'          => 'subjectNameDegree',
                                            'id'            => 'subjectNameDegree',
                                            'class'         => 'form-control',
                                            'placeholder'   => 'subject name',
                                            'type'          => 'text',
                                            'required'      => 'required'
                                        ));  
                                    echo form_input(array(
                                            'name'          => 'subjectNameDegreeId',
                                            'id'            => 'subjectNameDegreeId',
                                            'class'         => 'form-control',
                                            'type'          => 'hidden'
                                        )); ?>
                                </div>
                                <div class="form-group">
                                    <?php
                                        form_input(array(
                                        'name'          => 'std_name',
                                        'id'            => 'std_name',
                                        
                                        'class'         => 'form-control',
                                        'placeholder'   => 'Student name',
                                        'type'          => 'hidden',
                                      ));

                                  ?>
                                </div>
                                <div class="form-group">

                                                <?php
                                                    form_input(array(
                                                  'name'          => 'std_fname',
                                                  'id'            => 'std_fname',
                                                   
                                                  'class'         => 'form-control',
                                                  'placeholder'   => 'Father name',
                                                  'type'          => 'text',
                                                  ));
 
                                              ?>



                                           </div>
                                       <div class="form-group">
                                          <button type="submit" name="search" value="search"   class="btn btn-theme"><i class="fa fa-search"></i> Search </button>
                                         
                                                    <button type="submit" name="export" value="export"   class="btn btn-theme"><i class="fa fa-download"></i> Export </button>
                                                    <button type="button" name="print" value="print"  onClick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print </button>
                                         
                                          
                                         
                                      </div>
                                    </div>  
                                     
                                </div>
                            
                    <?php
                    echo form_close();
                    ?>
                </div><!--//section-content-->
         </section>
         
              
        
            <div class="table-responsive">    
                 <div id="div_print">
               <table class="table table-hover">

                    <thead>
                        <tr>
                            <th>#</th>
                          
                            <th>Subject Name</th>
                            <th>Teacher Name</th>
                            <th>Section</th>
                            <th>Details</th>
                            
                        </tr>
                    </thead>
                 <tbody>
                    
                     <?php
                     
                     if(@$subjectResult):

                         $sn= '';
                         foreach($subjectResult as $srRow):
                         $sn++;
                         echo '<tr>
                           <th>'.$sn.'</th>
                           
                            <th>'.$srRow->title.'</th>
                            <th>'.$srRow->emp_name.'</th>
                            <th> '.$srRow->name.'</th>
                            <th><a href="AttendanceController/subject_wise_sub_report_inter/'.$srRow->subject_id.'/'.$srRow->sec_id.'/'.$srRow->flag.'">Details</a></th>
                            
                            
                                </th>
                    </tr> ';
                         endforeach;
                     endif;
                     ?>
                     
                 </tbody>
                </table><!--//table-->
                <?php echo $print_log;?>
           </div>
             </div>
          <!--//contact-form-->
        </div>
        <!--//page-row-->
      </div>
      <!--//page-content-->
    </div>
    <!--//page-wrapper--> 
  </div>
  <!--//content-->
 
  <script language="javascript">
function printdiv(printpage)
{
var headstr = "<html><head><title></title></head><body>";
var footstr = "</body>";
var newstr = document.all.item(printpage).innerHTML;
var oldstr = document.body.innerHTML;
document.body.innerHTML = headstr+newstr+footstr;
window.print();
document.body.innerHTML = oldstr;
return false;
}
</script>