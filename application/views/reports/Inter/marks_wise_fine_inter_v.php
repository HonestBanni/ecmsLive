
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
                    
                    echo form_input(array(
                    'name'	=> 'college_no',
                    'value'	=> $college_no,
                    'class'     =>'form-control',
                    'placeholder'=>'College No'
                    ));
                    ?>
              </div>-->
              <!--//form-group-->
              <div class="form-group ">
                  <input name="fromDate" value="<?php echo $fromDate?>"type="text" class="form-control datepicker" placeholder="From Date">
              </div>
              <div class="form-group ">
                  <input name="toDate" value="<?php echo $toDate?>"type="text" class="form-control datepicker" placeholder="To Date">
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
                         <th><h4><strong>STUDENTS POSITION WISE FINE (INTER)</strong></h4></th>
                        <th><h4>Class : <?php $secname = $this->CRUDModel->get_where_row('sections',array('sec_id'=>$sectionId)); echo $secname->name ?></h4></th>
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
                      
                        if($CheckStd->flag ==1):
                            $classSubjects = $this->ReportsModel->get_classSubjects_rep(array('sec_id'=>$resRow->sec_id));
                        endif;
                        if($CheckStd->flag == 2):
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
               'sec_id'                         => $CS->section_id,
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
                       
                $data = array(
                        'college_no'            =>$resRow->college_no,
                        'student_id'            =>$resRow->student_id,
                        'std_name'              =>$resRow->student_name,
                        'from_month_present'    =>$fmp,
                        'from_month_absent'     =>$fma,
                        'total_month_present'   =>$tdp,
                        'total_month_absent'    =>$tda,
                        'sectionName'           =>$secname->name,
                        'user_id'               =>$userId,
                  );
                  $this->CRUDModel->insert('student_position',$data);
                $sn++;
                endforeach;
                endif;
                  $posion =         $this->db->get_where('student_position',array('user_id'=>$userId))->result();
//                $posion =  $this->db->query('SELECT  * FROM  `student_position` where user_id='.$userId.' ORDER BY `college_no` ASC')->result();
           ?>
            <table class="table table-boxed table-hover">
              <thead> 
                 <tr>
                    <th>#</th>
                    <th>College #</th>
                    <th>Name</th>
                    <th>Total</th>
                    <th>Attend</th>
                    <th>Absent</th>
                    <th>Leaves</th>
                    <th>Difference</th>
                    <th>Total Fine</th>
                </tr>
              </thead>
              <tbody>
          <?php
          $sn = 1;
          $defaulter = '';
          $gDifference = '';
          foreach($posion as $stRow):
                        $this->db->select('sum(total_classess) as total_leaves');
                        $this->db->where('leave_date BETWEEN "'.date("Y", strtotime($startDate)).'-'.date("m", strtotime($startDate)).'-01'.'"and "'.date("Y", strtotime($endDate)).'-'.date("m", strtotime($endDate)).'-31'.'"');
                        $this->db->group_by('student_id');    
              $leaeve = $this->db->get_where('student_fine',array('student_id'=>$stRow->student_id))->row();
              $gLeave = '';
              if($leaeve):
                  $gLeave =$leaeve->total_leaves;
                   
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
                 
             $defaulter  = '';
             if($to_pert >0):
               
              else:
              $defaulter = 'Defaulter';
             endif; 
             
             $gDifference =$stRow->total_month_absent-$gLeave;
             
             $fine = $gDifference*5; 
              echo '<tr><td>'.$sn.'</td>';
              echo '<td>'.$stRow->college_no.'</td>';
              echo '<td>'.$stRow->std_name.'</td>';
              echo '<td>'.$to_total.'</td>';
              echo '<td>'.$stRow->total_month_present.'</td>';
              echo '<td>'.$stRow->total_month_absent.'</td>';
              echo '<td>'.$gLeave.'</td>';
              echo '<td>'.$gDifference.'</td>';
              echo '<td>'.'Rs. '.$fine.'</td></tr>';
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