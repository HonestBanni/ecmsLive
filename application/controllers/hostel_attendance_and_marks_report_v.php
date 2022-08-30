
<script language="javascript">
  function printdiv(printpage)
  {
    var headstr = "<html><head><title></title></head><body>";
    //var headstr = "<html><head><title></title></head><body><p><img  class='img-responsive' src='assets/images/logo.png' alt='Edwardes College Peshawar'></p>";
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
    <div class="page-content">
      <div class="row">
        <article class="contact-form col-md-12 col-sm-7  page-row">                            
          <?php echo form_open('',array('class'=>'form-inline')); ?>
            <div class="row">
            <div class="col-md-12 ">
              
<!--              <div class="form-group">
                 
              </div>-->
              <!--//form-group-->
              <div class="form-group ">
                  <input name="college_no" value="<?php if($college_no): echo $college_no;endif; ?>"type="number" class="form-control" placeholder="College No">
              </div>
              
              <!--//form-group-->     
              <div class="form-group">
                  <input name="student_name" type="text" value="<?php if($student_name): echo $student_name;endif; ?>" class="form-control" placeholder="Name">
              </div>
              <!--//form-group-->
              <div class="form-group ">
                <input name="father_name" type="text" value="<?php if($father_name): echo $father_name;endif; ?>"  class="form-control" placeholder="Father name">
              </div>
              <!--//form-group-->
              
              <div class="form-group">
                <?php 
                    //$slctdCategory = (isset($product->category) ? $product->category : '');
                    echo form_dropdown('program', $program, $programId,  'class="form-control" id="feeProgrameId"');
                ?>
              </div>
<!--              <div class="form-group">
                <?php 
                    //$slctdCategory = (isset($product->category) ? $product->category : '');
                    echo form_dropdown('prospectus_batch', $batch, $batch_id,  'class="form-control" id="batch_id"');
                ?>
              </div>-->
              <!--//form-group-->
              <div class="form-group">
                <?php 
                echo form_dropdown('sub_program', $subprogrames, $subprogramId,  'class="form-control" id="showFeeSubPro"');
                ?>
              </div>
              
<!--              <div class="form-group">
                <?php 
                $sections = array( ''=>'Sub Program');
                echo form_dropdown('sections_name', $sections, $sectionId,  'class="form-control" id="showSections"');
                ?>
              </div>-->
              
              
               
                  
                     <div class="form-group">
                        <button type="submit" name="search" value="search" class="btn btn-theme">
                            <i class="fa fa-search">
                          </i> Search
                        </button>
                        <button type="button" name="print" value="print"  onClick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print </button> 
                            
                      </div>
  
               
            </div>
          </div>

         <?php echo form_close(); ?>     
            <?php
            if(@$result):
            ?>
            <div id="div_print">
            <h3 class="has-divider text-highlight">Result :<?php echo $countResult?></h3>
            <table class="table table-boxed table-hover">
              <thead>
                <tr>
                  <th>#</th>
                    <th>College #</th>
                    <th>Picture</th>
                    <th>Name</th>
                    <th>Father name</th>
                    <th>Program</th>
                    <th>Sub program</th>
                    <th>Section</th>
                    <th>P</th>
                    <th>A</th>
                    <th>%</th>
                    <th>Monthly Test %</th>
                     
                </tr>
              </thead>
              <tbody>
                  <?php
                  $sn = 1;
                  
                   foreach($result as $resRow):
                         
//                        $attendance = $this->CRUDModel->get_student_attendance_details($resRow->student_id,$resRow->sec_id);
//                        $marks      = $this->CRUDModel->get_student_montly_marks_details($resRow->student_id,$resRow->sec_id);
//                      
                      echo '<tr>
                                <td>'.$sn.'</td>
                                <td>'.$resRow->college_no.'</td>';
                                if(empty($resRow->applicant_image)):
                                    echo '<td><img src="assets/images/students/user.png" width="60" height="40"></td>';
                                else:
                                    echo '<td><img src="assets/images/students/'.$resRow->applicant_image.'" width="60" height="40"></td>';
                                endif;
                                
                                echo '<td>'.$resRow->student_name.'</td>
                                <td>'.$resRow->father_name.'</td>
                                <td>'.$resRow->programe_name.'</td>
                                <td>'.$resRow->subprogram.'</td>
                                <td>'.$resRow->sectionName.'</td>
                                <td>'.$resRow->Present.'</td>
                                <td>'.$resRow->Absent.'</td>
                                <td>'.$resRow->Persantage.'</td>
                                 <td>'.$resRow->PercentageMarks.'</td>
                                 
                                </td>
                              </tr>';
                   $sn++;
                  endforeach;
                ?>
                
              </tbody>
            </table>
            <?php
            else:
                echo '<h3 class="has-divider text-highlight">No query found..</h3>';
            endif;
            ?>
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
 
 