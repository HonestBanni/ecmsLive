
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
                                            'name'          => 'college_number',
                                            'id'            => 'college_number',
                                            'value'         => $college_number,
                                            'class'         => 'form-control',
                                            'placeholder'   => 'College #',
                                            'type'          => 'text'
                                        )); ?>
                                </div>
                                <div class="form-group">
                                    <?php
                                      echo form_input(array(
                                        'name'          => 'std_name',
                                        'id'            => 'std_name',
                                        'value'         => $std_name,
                                        'class'         => 'form-control',
                                        'placeholder'   => 'Student name',
                                        'type'          => 'text',
                                      ));

                                  ?>
                                </div>
                                <div class="form-group">
                        <?php
                          echo form_input(array(
                          'name'          => 'std_fname',
                          'id'            => 'std_fname',
                          'value'         => @$std_fname,
                          'class'         => 'form-control',
                          'placeholder'   => 'Father name',
                          'type'          => 'text',
                          ));
                      ?>
                   </div>
                    <div class="form-group ">
                        <?php 
                        echo form_dropdown('section', $subPrograme,@$sectionId,  'class="form-control" id="sub_program_alevel"');
                        ?>
                    </div>
                    <div class="form-group ">
                        <select class="form-control" id="section_alevel_dropdown" name="section">
                        </select>
                    </div>

                <div class="form-group">
                  <button type="submit" name="search" value="search"   class="btn btn-theme"><i class="fa fa-search"></i> Search </button>
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
                    <th>Picture</th>
                    <th>College#</th>
                    <th>Name</th>
                    <th>Father Name</th>
                    <th>Section</th>
                    <th>Subjects</th>

                </tr>
            </thead>
         <tbody>          
     <?php
     if(@$subject_record):
         $sn= '';
         foreach($subject_record as $srRow):
         $sn++;
         $subjects = $this->AttendanceModel->get_subject_list('student_subject_alloted',array('student_id'=>$srRow->student_id));

     echo '<tr>
           <th>'.$sn.'</th>
           <th>Picture</th>
            <th>'.$srRow->college_no.'</th>
            <th>'.$srRow->student_name.'</th>
            <th>'.$srRow->father_name.'</th>
            <th>'.$srRow->section_name.'</th><th>';
            foreach($subjects as $subjects):
                    echo $subjects->title.',';
            endforeach;

            echo '</th>
    </tr>';
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