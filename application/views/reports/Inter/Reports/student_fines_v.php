
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
          <section class="course-finder" style="padding-bottom: 2%;">
            <h1 class="section-heading text-highlight">
                <span class="line"><?php echo $ReportName?> Search</span>
            </h1>
                <div class="section-content" >
                    <div class="row">
                        <?php echo form_open('',array('class'=>'course-finder-form','name'=>'reportForm'));   ?>
                        
                        <div class="col-md-12">
                                <div class="col-md-3 col-sm-5">
                                    <label for="name">Program</label>
                                    <?php echo form_dropdown('program', $program, $programId,  'class="form-control" required="required" id="feeProgrameId"');?>
                                </div>
                                <div class="col-md-3 col-sm-5">
                                    <label for="name">Batch</label>
                                        <?php echo form_dropdown('batch', $batch, $batchId,  'class="form-control" required="required"'); ?>
                                </div>
                                <div class="col-md-3 col-sm-5">
                                    <label for="name">Sub Program</label>
                                    <?php echo form_dropdown('sub_program', $subprogrames, $subprogramId,  'class="form-control" required="required"  id="showFeeSubPro"');?>
                                </div>
                            <div class="col-md-3 col-sm-5 ">
                                <label for="name">Section</label>
                                <?php echo form_dropdown('sections_name', $sections, $sectionId,  'class="form-control" id="showSections"');?>
                            </div>
                                
                            <div class="col-md-3 col-sm-5">
                                <label for="name">From Date</label>
                                <input name="fromDate" value="<?php echo $fromDate?>"type="text" class="form-control datepicker" readonly="readonly" placeholder="From Date">
                            </div>
                            <div class="col-md-3 col-sm-5 ">
                                <label for="name">To Date</label>
                                <input name="toDate" value="<?php echo $toDate?>"type="text" class="form-control datepicker" readonly="readonly" placeholder="To Date">
                            </div>
                            
                            
                            
                            
                        </div>  
                        <p>&nbsp;</p>
                        <div class="col-md-12">
                            <div class="col-md-12 col-sm-5">
                                <div class="form-group">
                                     <button type="submit" name="search" value="search" class="btn btn-theme"><i class="fa fa-search"></i> Search</button>
                                     <button type="submit" name="excel" value="excel" class="btn btn-theme"><i class="fa fa-file-excel-o"></i> Excel</button>
                                     <button type="button" name="print" value="print" onclick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print </button>
                                        
                                </div>  
                            </div>  
                        </div>
                    </div>
                            
                    <?php
                    echo form_close();
                    ?>
                </div><!--//section-content-->
         </section>
           
            
          </div>

         <?php  if(@$result): ?>     
            
            <h3 class="has-divider text-highlight">Result :<?php echo count($result)?></h3>
            <div id="div_print">
                
         
                <table class="table table-boxed table-hover" style="font-size: 12px">
                    <thead>
                     <tr>
                         <th><h4><strong>STUDENTS FINE (INTER)</strong></h4></th>
                        <th></th>
                        <th><h4>From : <?php  echo date("M-Y", strtotime($fromDate)); ?></h4></th>
                        <th><h4>To : <?php  echo date("M-Y", strtotime($toDate)); ?></h4></th>
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
                        if(@$CheckStd->flag ==1):
                            $classSubjects = $this->ReportsModel->get_classSubjects_rep(array('sec_id'=>$resRow->sec_id));
                        endif;
                        if(@$CheckStd->flag == 2):
                            $classSubjects = $this->ReportsModel->get_subject_list_report('student_subject_alloted',array('student_id'=>$resRow->student_id));
                        endif;

                        $month      = date("m", strtotime($fromDate));
                        $year       = date("Y", strtotime($fromDate));
                        $fmp     = 0;
                        $fma     = 0;
                        $fmtotal = 0;

                        $tdp=0;
                        $tda=0;
                        $total=0;
                        foreach($classSubjects as $CS):
                            $where = array(
                                'subject_id'                => $CS->subject_id,
                                'sec_id'                    => $CS->section_id,
                                'student_id'                => $resRow->student_id,
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
                                'sec_id'                    => $CS->section_id,
                                'class_alloted.subject_id'      => $CS->subject_id,
                                'student_id'                    => $resRow->student_id,
                            );

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
                        $perstage  = '';
                        $total_classes = $tdp+$tda;
                        if($total_classes):
                            $perstage = $tdp/$total_classes *100;
                        endif;
                        $data = array(
                            'college_no'            => $resRow->college_no,
                            'student_id'            => $resRow->student_id,
                            'std_name'              => $resRow->student_name,
                            'father_name'           => $resRow->father_name,
                            'from_month_present'    => $fmp,
                            'from_month_absent'     => $fma,
                            'total_month_present'   => $tdp,
                            'total_month_absent'    => $tda,
                            'total_classes'         => $total_classes,
                            'sectionName'           => $resRow->sectionName,
                            'perstage'              => round($perstage,2),
                            'user_id'               => $userId
                        );
                        $this->CRUDModel->insert('student_position',$data);
                        $sn++;
                    endforeach;
                endif;
                $posion = array();
                                  $this->db->order_by('perstage','desc');
                $posion1     =   $this->db->get_where('student_position',array('user_id'=>$userId,'perstage'=>'100'))->result();
                                  $this->db->order_by('perstage','desc');
                $posion2     =   $this->db->get_where('student_position',array('user_id'=>$userId,'perstage !='=>'100'))->result();
                
              

           ?>
            <table class="table table-boxed table-hover" style="font-size: 12px">
              <thead> 
                 <tr>
                    <th>#</th>
                    <th>College #</th>
                    <th>Name</th>
                    <th>F-Name</th>
                    <th>Group</th>
                    <th>Total</th>
                    <th>Present</th>
                    <th>Absent</th>
                    <th>%</th>
                    <th>Leave Approve</th>
                     
                </tr>
              </thead>
              <tbody>
          <?php
          $sn = 1;
          $defaulter = '';
          $gDifference = '';
          foreach(array_merge($posion1,$posion2) as $stRow):
                        $this->db->select('sum(total_classess) as total_leaves');
                        $this->db->where('leave_date BETWEEN "'.date("Y", strtotime($startDate)).'-'.date("m", strtotime($startDate)).'-01'.'"and "'.date("Y", strtotime($endDate)).'-'.date("m", strtotime($endDate)).'-31'.'"');
                        $this->db->group_by('student_id');    
              $leaeve = $this->db->get_where('student_fine',array('student_id'=>$stRow->student_id))->row();
              $gLeave = '';
              if($leaeve):
                  $gLeave =$leaeve->total_leaves;
                   
              endif;
              echo '<tr><td>'.$sn.'</td>';
              echo '<td>'.$stRow->college_no.'</td>';
              echo '<td>'.strtoupper($stRow->std_name).'</td>';
              echo '<td>'.strtoupper($stRow->father_name).'</td>';
              echo '<td>'.$stRow->sectionName.'</td>';
              echo '<td>'.$stRow->total_classes.'</td>';
              echo '<td>'.$stRow->total_month_present.'</td>';
              echo '<td>'.$stRow->total_month_absent.'</td>';
              echo '<td>'.$stRow->perstage.'</td>';
              echo '<td>'.$gLeave.'</td>';
              $sn++;
          endforeach;
          ?> 
              </tbody>
            </table>
                
            <?php
            echo $print_log;
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
 
 
  
  
    <script type="text/javascript">
$(function() {
  $('.datepicker').datepicker( {
     changeMonth: true,
      changeYear: true,
       dateFormat: 'dd-mm-yy'

  });
});
</script>