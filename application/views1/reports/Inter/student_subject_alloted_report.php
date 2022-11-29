
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
                        <?php echo form_open('',array('class'=>'course-finder-form','name'=>'reportForm'));   ?>
                        
                        <div class="col-md-12">
                            
                            <div class="col-md-2 col-sm-5">
                               <label for="name">Student Name</label>
                               
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
                            <div class="col-md-2 col-sm-5">
                               <label for="name">Father Name</label>
                               
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
                            <div class="col-md-2 col-sm-5">
                               <label for="name">College No.</label>
                                
                                <?php
                                echo form_input(array(
                                        'name'          => 'college_number',
                                        'id'            => 'college_number',
                                        'value'         => $college_number,
                                        'class'         => 'form-control',
                                        'placeholder'   => 'College #',
                                        'type'          => 'text'
                                    )); 
                                ?>
                                
                            </div>
                            <div class="col-md-2 col-sm-5">
                               <label for="name">Form No.</label>
                                
                                <?php
                                echo form_input(array(
                                        'name'          => 'form_number',
                                        'id'            => 'form_number',
                                        'value'         => $form_number,
                                        'class'         => 'form-control',
                                        'placeholder'   => 'Form #',
                                        'type'          => 'text'
                                    )); 
                                ?>
                         
                            </div>
                            <div class="col-md-2 col-sm-5">
                                <label for="name">Gender</label>
                                
                                    <?php 
                                        echo form_dropdown('genderId', $gender, $genderId,  'class="form-control" id="genderId"');
                                    ?>
                                
                            </div>
                            <div class="col-md-2 col-sm-5">
                                <label for="name">Batch</label>
                                <div class="input-group">
                                    <?php 
                                        echo form_dropdown('batchId', $batchName,$batchId,  'class="form-control" id="batchId"');
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-5">
                                <label for="name">Sub Program</label>
                                
                                    <?php 
                                        echo form_dropdown('subPrograme', $subPrograme,$subProgrameId,  'class="form-control" id="new_sub_program"');
                                    ?>
                               
                            </div>
                            <div class="col-md-2 col-sm-5">
                                <label for="name">Subjects</label>
                                
                                    <?php 
                                        echo form_dropdown('subjects', $subjects, $subjectId,  'class="form-control" id="subject_dropdown"');
                                    ?>
                            
                            </div>
                        </div>  
                        <p>&nbsp;</p>
                        <div class="col-md-12">
                            <div class="col-md-12 col-sm-5">
                                <div class="form-group">
                                    <button type="submit" name="search_log" value="search_log"   class="btn btn-theme"><i class="fa fa-search"></i> Search </button>
                                    <button type="submit" name="export_report" value="export_report"  class="btn btn-theme"><i class="fa fa-plus"></i> Export Excel </button>
                                    <button type="submit" name="export_report_single" value="export_report_single"  class="btn btn-theme"><i class="fa fa-plus"></i> Export Excel Single Subject </button>
                                    <button type="button" name="print" value="print" onclick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print</button>      
                                </div>  
                            </div>  
                        </div>
                    </div>
                            
                    <?php
                    echo form_close();
                    ?>
                </div><!--//section-content-->
         </section>
         
               <?php
                     
                     if(!empty($student_result)):
                         
                ?>
        
            <div class="table-responsive">    
                 <div id="div_print" >
                     <table class="table table-hover" style="font-size:12px;">

                    <thead>
                        <tr>
                            <th>S No.</th>
                            <th>College No.</th>
                            <th>Form No.</th>
                            <th>Student Name</th>
                            <th>Father Name</th>
                            <th>Sub Program</th>
                            <th>Subjects</th>
                        </tr>
                    </thead>
                 <tbody>
                    
                     <?php
                     
                     
                          
                        $sn= '';
                         
                        foreach($student_result as $srRow):
                           
                            if(@$subjectId):
                                $subject_results = $this->ReportsModel->student_alloted_subjects(array('student_subject_alloted.subject_id'=>$subjectId,'student_subject_alloted.student_id'=>$srRow->student_id));
//                           echo '<pre>';print_r($subject_results);die;
                                $assigned_subjects = $this->ReportsModel->student_alloted_subjects(array('student_subject_alloted.student_id'=>$srRow->student_id));
                                if($subject_results):
                                    $sn++;
                                    echo '<tr>
                                        <td>'.$sn.'</td>
                                        <td>'.$srRow->college_no.'</td>
                                        <td>'.$srRow->form_no.'</td>
                                        <td>'.$srRow->student_name.'</td>
                                        <td>'.$srRow->father_name.'</td>
                                        <td>'.$srRow->sub_pro_name.'</td><td>';
                                        foreach($assigned_subjects as $rowList):
                                            if($rowList->subject_id == $subjectId):
                                                echo '<strong>'.$rowList->subject_name.'</strong>, ';
                                            else:
                                                echo $rowList->subject_name.', ';
                                            endif;
                                        endforeach;
                                    echo '</td></tr>'; 
                                endif;
                            else:
                                
                                $subject_result = $this->ReportsModel->student_alloted_subjects(array('student_subject_alloted.student_id'=>$srRow->student_id)); 
//                                  echo '<pre>';print_r($subject_result);die;
                                if($subject_result):
                                    $sn++;
                                    echo '<tr>
                                       <td>'.$sn.'</td>
                                        <td>'.$srRow->college_no.'</td>
                                        <td>'.$srRow->form_no.'</td>
                                        <td>'.$srRow->student_name.'</td>
                                        <td>'.$srRow->father_name.'</td>
                                        <td>'.$srRow->sub_pro_name.'</td><td>';
                                        foreach($subject_result as $rowList):
                                            echo $rowList->subject_name.', ';
                                        endforeach;
                                    echo '</td></tr>'; 
                                endif;
                            endif;
                         
                        endforeach;
                        
                   
                     ?>
                     
                 </tbody>
                </table><!--//table-->
           </div>
             </div>
          <?php
          
            endif;
          ?>
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

<script language="javascript">
    
    jQuery(document).ready(function(){
      jQuery('#new_sub_program').on('change',function(){
          var subPro = jQuery('#new_sub_program').val();
         jQuery.ajax({
             type:'post',
             url : 'ReportsController/sub_program_subject',
             data:{'subPro':subPro},
             success:function(result){
                jQuery('#subject_dropdown').html(result);
             }

         });
      });
    });

</script>
