
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
                <?php
                    $student_id = array(
                    'name'	=> 'college_no',
                    'value'	=> $college_no,
                    'class'     =>'form-control',
                    'placeholder'=>'College No'
                    );
                    echo form_input($college_no);
                    ?>
              </div>-->
              <!--//form-group-->
              <div class="form-group ">
                  <input name="fromDate" value="<?php if($fromDate): echo $fromDate;endif; ?>"type="date" class="form-control" placeholder="From Date">
              </div>
              <div class="form-group ">
                  <input name="toDate" value="<?php if($toDate): echo $toDate;endif; ?>"type="date" class="form-control" placeholder="To Date">
              </div>
              
              
<!--              <div class="form-group ">
                  <input name="college_no" value="<?php if($college_no): echo $college_no;endif; ?>"type="number" class="form-control" placeholder="College No">
              </div>
              
              //form-group     
              <div class="form-group">
                  <input name="student_name" type="text" value="<?php if($student_name): echo $student_name;endif; ?>" class="form-control" placeholder="Name">
              </div>
              //form-group
              <div class="form-group ">
                <input name="father_name" type="text" value="<?php if($father_name): echo $father_name;endif; ?>"  class="form-control" placeholder="Father name">
              </div>-->
              <!--//form-group-->
              
              <div class="form-group">
                <?php 
                    //$slctdCategory = (isset($product->category) ? $product->category : '');
                      form_dropdown('program', $program, $programId,  'class="form-control" id="programId"');
                ?>
              </div>
              <!--//form-group-->
              <div class="form-group">
                <?php 
                  form_dropdown('sub_program', $subprogrames, $subprogramId,  'class="form-control" id="my_id"');
                ?>
              </div>
              
              <div class="form-group">
                <?php 
                echo form_dropdown('sections_name', $sections, $sectionId,  'class="form-control" id="my_id"');
                ?>
              </div>
                    <div class="form-group">
                        <button type="submit" name="search" value="search" class="btn btn-theme"><i class="fa fa-search"></i> Search</button>
                        <button type="button" name="print" value="print" onclick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print </button>
                        
                    </div>
  
               
            </div>
          </div>

         <?php echo form_close(); 
           if(@$result):
         ?>     
            
            <h3 class="has-divider text-highlight">Result :<?php echo $countResult?></h3>
            <div id="div_print">
                
         
                <table class="table table-boxed table-hover">
                    <thead>
                     <tr>
                         <th><h4><strong>STUDENTS POSITION MARKS WISE</strong></h4></th>
                    
                        <th><h4>Class :</h4></th>
                        <th><h4><?php $secname = $this->CRUDModel->get_where_row('sections',array('sec_id'=>$sectionId)); echo $secname->name ?></h4></th>
                        <th><h4>Month</h4></th>
                        <th><h4>From :<?php  echo date("d-M-Y", strtotime($fromDate)); ?></h4></th>
                        <th><h4>To : <?php  echo date("d-M-Y", strtotime($toDate)); ?></h4></th>
                        <th></th>
                  </tr>
                  </thead>
                </table>
                <?php
           
                    $startDate  =  date("Y-m", strtotime($fromDate));
                    $endDate    =  date("Y-m", strtotime($toDate));
                if($result):
                    $this->db->truncate('student_position');
 
                
            
                    $sn = 1;
                     
                   foreach($result as $resRow):
                    
                     
                       
                       $CheckStd = $this->CRUDModel->get_where_row('class_alloted',array('sec_id'=>$resRow->sec_id));
                      
                        if($CheckStd->flag ==1):
                            $classSubjects = $this->ReportsModel->get_classSubjects_rep(array('sec_id'=>$resRow->sec_id));
                        endif;
                        if($CheckStd->flag == 2):
                            $classSubjects = $this->ReportsModel->get_subject_list_report('student_subject_alloted',array('student_id'=>$resRow->student_id));
//                            $classSubjects = $this->ReportsModel->get_subject_list_report('student_subject_alloted',array('student_id'=>$resRow->student_id));
//                       
                        endif;
// echo '<pre>';print_r($classSubjects);die;
//                        echo '<pre>';print_r($classSubjects);die;
                        $month      = date("m", strtotime($fromDate));
                        $year       = date("Y", strtotime($fromDate));
                         
                     
                            $fmp     = 0;
                            $fma     = 0;
                            $fmtotal = 0;
                            
                            $tdp=0;
                            $tda=0;
                            $total=0;
                      
                            $rdp=0;
                            $rda=0;
                            $rtotal=0;
                      
                                        
                         foreach($classSubjects as $CS):

                        $where = array(
                              'subject_id'                => $CS->subject_id,
                              'sec_id'                    => $CS->section_id,
                              'student_id'                => $resRow->student_id,
//                              'student_id'                => '5361',
                              'month(attendance_date)'    => $month,
                              'year(attendance_date)'     => $year,
                          );
                            $from_Month_record = $this->ReportsModel->get_student_att($where);
                                    
                                        foreach($from_Month_record as $stdAtt):
                                          if($stdAtt->status == 1):
                                                    if($stdAtt->ca_classcount ==2):
                                                            $fmp++;
                                                            $fmp++;
                                                        else:
                                                            $fmp++;
                                                    endif;
                                                    else:
                                                       if($stdAtt->ca_classcount ==2):
                                                            $fma++;
                                                            $fma++;
                                                        else:
                                                            $fma++;
                                                    endif;
                                                endif;
                                            
                                               $fmtotal = $fma+$fmp; 
                                               
                                               
                                        endforeach;
                                        
                                        
                                        $wheretotal = array(
                                               'sec_id'                         => $CS->section_id,
                                                'class_alloted.subject_id'      => $CS->subject_id,
                                                'student_id'                    => $resRow->student_id,
                                               
                                             );
                                        
                                        $range_data['start']  = date("Y-m-d", strtotime($fromDate));
//                                        $range_data['start']  = date("Y", strtotime($startDate)).'-'.date("m", strtotime($startDate)).'-01';
                                        $range_data['end']    = date("Y-m-d", strtotime($toDate));
//                                        $range_data['end']    = date("Y", strtotime($endDate)).'-'.date("m", strtotime($endDate)).'-31';
//                                        echo '<pre>';print_r($startDate);
//                                        echo '<pre>';print_r($startDate);
                                        $range_date = $this->ReportsModel->get_student_attendance_date($wheretotal,$range_data);

                                                
                                                     foreach($range_date as $rstdAtt):
                                                        if($rstdAtt->status == 1):
                                                            if($rstdAtt->ca_classcount ==2):
                                                                    $rdp++;
                                                                    $rdp++;
                                                                else:
                                                                    $rdp++;
                                                            endif;
                                                            else:
                                                               if($rstdAtt->ca_classcount ==2):
                                                                    $rda++;
                                                                    $rda++;
                                                                else:
                                                                    $rda++;
                                                            endif;
                                                        endif;
                                                  
                                                    endforeach;
                                        $data['start']  = date("Y", strtotime($startDate)).'-'.date("m", strtotime($startDate)).'-01';
                                        $data['end']    = date("Y", strtotime($endDate)).'-'.date("m", strtotime($endDate)).'-31';
                                        $to_date = $this->ReportsModel->get_student_attendance_date($wheretotal,$data);

                                                
                                                     foreach($to_date as $tstdAtt):
                                                        if($tstdAtt->status == 1):
                                                            if($tstdAtt->ca_classcount ==2):
                                                                    $tdp++;
                                                                    $tdp++;
                                                                else:
                                                                    $tdp++;
                                                            endif;
                                                            else:
                                                               if($tstdAtt->ca_classcount ==2):
                                                                    $tda++;
                                                                    $tda++;
                                                                else:
                                                                    $tda++;
                                                            endif;
                                                        endif;
                                                  
                                                    endforeach;
                                        
                          endforeach;
                         
//                                                    $whereMarks         = array('monthly_test_details.student_id'=>'5360');
                                                    $whereMarks         = array('monthly_test_details.student_id'=>$resRow->student_id);
                                                    $dateMark['start']  = date("Y", strtotime($startDate)).'-'.date("m", strtotime($startDate)).'-01';
                                                    $dateMark['end']    = date("Y", strtotime($endDate)).'-'.date("m", strtotime($endDate)).'-31';
                                                    
                                                    $TMO = $this->ReportsModel->get_test_marks_result_monthwise($whereMarks,$dateMark);
                                                    $TMOM = 0;
                                                    $TMTM = 0;
                                                    foreach($TMO as $TMQRow):
                                                        $TMOM  += $TMQRow->omarks;
                                                        $TMTM  += $TMQRow->tmarks;
                                                       endforeach;
                                                      
                                                      
                                                $TMG_PER=0;
                                                    if($TMTM):
                                                        $TMG_PER = ($TMOM/$TMTM)*100; 
                                                   endif;
                                
                                      
                                        $data = array(
                                                'college_no'            =>$resRow->college_no,
                                                'std_name'              =>$resRow->student_name,
                                                'from_daily_present'    =>$rdp,
                                                'from_daily_absent'     =>$rda,
                                                
                                                'from_month_present'    =>$fmp,
                                                'from_month_absent'     =>$fma,
                                                'total_month_present'   =>$tdp,
                                                'total_month_absent'    =>$tda,
                                                'obtained_marks'        =>$TMOM,
                                                'total_marks'           =>$TMTM,
                                                'perstage'              =>$TMG_PER,
                                                'sectionName'           =>$secname->name,
                                                'user_id'               =>$userId,
                                          );
        
                                                   
                                          $this->CRUDModel->insert('student_position',$data);

        
              
                   $sn++;
                  endforeach;
                endif;
                      $posion =  $this->db->query('SELECT  *,
                            FIND_IN_SET( `perstage`,`perstages`) AS rank FROM  `student_position`
                            CROSS JOIN (SELECT  GROUP_CONCAT(
                                        DISTINCT `perstage`
                                        ORDER BY `perstage`  DESC ) AS  `perstages`
                                        FROM `student_position`)  `perstages` where user_id='.$userId.' ORDER BY `rank` ASC')->result();
           
        
               
                
                
            ?>
            <table class="table table-boxed table-hover">
              <thead>
                 
               
                <tr>
                  <th> </th>
                  
                  <th> </th>
                    <th> </th>
                   
                    <th colspan="3">A/P= Total(%)</th>
                    
                    <th colspan="3">Obt/Total = %</th>
                    
                     
 
                </tr>
                 <tr>
                  <th>#</th>
                  
                  <th>College #</th>
                    <th>Student Name</th>
                    <th>Attendance of <?php  echo date("M-y", strtotime($fromDate)); ?></th>
                    <th>Upto <?php  echo date("d-M-Y", strtotime($toDate)); ?></th>
                    <th>Total Lectures</th>

                    <th>Marks</th>
                    <th>Position</th>
                    <th>Status</th>
 
                </tr>
              </thead>
              <tbody>
                  
                      <?php
                      $sn = 1;
                      $defaulter = '';
                      foreach($posion as $stRow):
                         
                          $date_range_total = $stRow->from_daily_absent+$stRow->from_daily_present;
                           $date_range_pert = '';
                          if($date_range_total):
                          $date_range_pert = ($stRow->from_daily_present/$date_range_total)*100;
                      endif;
                          
                         $from_total = $stRow->from_month_absent+$stRow->from_month_present;
                      $from_pert = '';
                      if($from_total):
                          $from_pert = ($stRow->from_month_present/$from_total)*100;
                      endif;
                      $to_total = $stRow->total_month_absent+$stRow->total_month_present;
                        
                       $to_pert = '';
                         if($to_total):
                              $to_pert = ($stRow->total_month_present/$to_total)*100;
                         endif;
                         $rank       = '';
                         $defaulter  = '';
                         if($stRow->perstage >0):
                             $rank = $stRow->rank;
                             
                          if($stRow->perstage <=39):
                              $defaulter = 'Defaulter';
                          endif;
                        
                          if($to_pert <=75):
                              $defaulter = 'Defaulter';
                          endif;
                         
                         
                         
                         else:
                             $rank = '';
                          $defaulter = 'Defaulter';
                         endif;
 
                         
                          echo '<tr><td>'.$sn.'</td>';
                          echo '<td>'.$stRow->college_no.'</td>';
                          echo '<td>'.strtoupper($stRow->std_name).'</td>';
                          
                          echo '<td>'.$stRow->from_month_absent.'/'.$stRow->from_month_present.' = '.$from_total.' ('.round($from_pert,1).')</td>';
                          echo '<td>'.$stRow->from_daily_absent.'/'.$stRow->from_daily_present.' = '.$date_range_total.' ('.round($date_range_pert,1).')</td>';
                          echo '<td>'.$stRow->total_month_absent.'/'.$stRow->total_month_present.' = '.$to_total.' ('.round($to_pert,1).')</td>';
                          
                            echo '<td>'.$stRow->obtained_marks.'/'.$stRow->total_marks.' = '.round($stRow->perstage,1).' %</td>';
                           
                        
//                          echo '<td>'.$rank.'</td></tr>';
                          echo '<td>'.$rank.'</td>';
                          echo '<td>'.$defaulter.'</td></tr>';
                          $sn++;
                      endforeach;
                      ?>
                 
                
              </tbody>
            </table>
                <h3 class="has-divider text-highlight">Note: Attendance less than 75% and Monthly test less than 39% will be considered as <span class="text-danger">Defaulter.</span></h3>
                <?php echo $print_log;?>
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
 
 
  
  
            