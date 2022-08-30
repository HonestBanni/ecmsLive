
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
              <div class="form-group">
                <?php 
                echo form_dropdown('programe_id', $program,$programe_id,  'class="form-control programe_id" id="feeProgrameId"');
                ?>
              </div>
            <div class="form-group">
                <?php 
                echo form_dropdown('sub_pro_id', $sub_program,$sub_pro_id,  'class="form-control sub_pro_id" id="showFeeSubPro"');
                ?>
              </div>    
              <div class="form-group">
                <?php 
                echo form_dropdown('batch_id',$batch,$batch_id,  'class="form-control" id="batch_id"');
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
             <div id="div_print"> 
            <h3 class="has-divider text-highlight" style="margin-left:37%">Top Ten Students Result</h3>
                <?php
                if($result):
                    $this->db->truncate('student_result_top_ten');
                    $sn = 1;
                   foreach($result as $resRow):   
                    $fmp     = 0;
                    $fma     = 0;
                    $fmtotal = 0;
                    $percentage=0;
                $where = array(
                      'sec_id'     => $resRow->sec_id,
                      'student_id' => $resRow->student_id
                  );
                $from_Month_record = $this->ReportsModel->get_student_att_result($where);               //echo '<pre>';print_r($from_Month_record);die;     
                foreach($from_Month_record as $stdAtt):
                  if($stdAtt->status == 1):
                            $fmp++;
                        else:   
                            $fma++;
                        endif;
                       $fmtotal = $fma+$fmp; 
                       $percentage = ($fmp/$fmtotal)*100; 
                $wheretotal = array(
                       'sec_id'     => $resRow->sec_id,                         
                       'student_id' => $resRow->student_id
                     );
                 endforeach;
                $whereMarks = array('pre_board_test_details.student_id'=>$resRow->student_id);
                $TMO = $this->ReportsModel->get_pre_board_marks_result($whereMarks);
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
                $total = ($percentage + $TMG_PER)/2;
                $data = array(
                    'applicant_image'    =>$resRow->applicant_image,
                    'college_no'         =>$resRow->college_no,
                    'std_name'           =>$resRow->student_name,
                    'from_month_present' =>$fmp,
                    'from_month_absent'  =>$fma,
                    'percentage'         =>$percentage,
                    'obtained_marks'     =>$TMOM,
                    'total_marks'        =>$TMTM,
                    'perstage'           =>$TMG_PER,
                    'sectionName'        =>$resRow->sectionName,
                    'total'              =>$total,
                    'user_id'            =>$userId,
                  );                                   
                $this->CRUDModel->insert('student_result_top_ten',$data);
                   $sn++;
                  endforeach;
                endif;
        $posion =  $this->db->query('SELECT  * FROM  `student_result_top_ten` where user_id='.$userId.' ORDER BY `total` DESC LIMIT 10' )->result();
        $posion =  $this->db->query('SELECT  *,
                    FIND_IN_SET( `total`,`totals`) AS rank FROM  `student_result_top_ten`
                    CROSS JOIN (SELECT  GROUP_CONCAT(
                    DISTINCT `total`
                    ORDER BY `total`  DESC ) AS  `totals`
                    FROM `student_result_top_ten`)  `totals` where user_id='.$userId.' ORDER BY `total` DESC LIMIT 10' )->result();
            ?>
            <table class="table table-boxed table-hover">
              <thead>
                <tr>
                  <th>S.No</th>
                  <th>Picture</th>
                  <th>College #</th>
                    <th>Student Name</th>
                    <th>Section</th>
                    <th>A/P= Total(%)</th>
                    <th>Obt/Total = (%)</th>
                    <th>Grand Total</th>
                    <th>Position</th>
                </tr>
              </thead>
              <tbody>   
              <?php
              $sn = 1;
              foreach($posion as $stRow):
               //   echo '<pre>';print_r($posion);die;
                 $from_total = $stRow->from_month_absent+$stRow->from_month_present;
              $from_pert = '';     
              if($from_total):
                  $from_pert = ($stRow->from_month_present/$from_total)*100;
              endif;  
              echo '<tr><td>'.$sn.'</td>';
              echo '<td><img src="assets/images/students/'.$stRow->applicant_image.'" style="height: 40px;width:60px;"></td>';
              echo '<td>'.$stRow->college_no.'</td>';
              echo '<td>'.$stRow->std_name.'</td>';
              echo '<td>'.$stRow->sectionName.'</td>';
              echo '<td>'.$stRow->from_month_absent.'/'.$stRow->from_month_present.' = '.$from_total.' ('.round($from_pert,2).' %)</td>';
                echo '<td>'.$stRow->obtained_marks.'/'.$stRow->total_marks.' = '.round($stRow->perstage,2).' %</td>';
                echo '<td>'.round($stRow->total, 2).' %</td>';
                echo '<td>'.$stRow->rank.'</td>';
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
 
 
  
  
            