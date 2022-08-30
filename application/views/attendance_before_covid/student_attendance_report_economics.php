
<script language="javascript">
    function printdiv(printpage)
    {
    var headstr = "<html><head><title></title></head><body><p></p>";
    var footstr = "</body>";
    var newstr = document.all.item(printpage).innerHTML;
    var oldstr = document.body.innerHTML;
    document.body.innerHTML = headstr+newstr+footstr;
    window.print();
    document.body.innerHTML = oldstr;
    return false;
    }
</script>

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
            <div class="col-md-12">
              <div class="form-group">
                  <label>From Date</label><br>
                  <input name="fromDate" value="<?php if($fromDate): echo $fromDate;endif; ?>"type="date" class="form-control" placeholder="From Date">
              </div>
              <div class="form-group ">
                  <label>To Date</label><br>
                  <input name="toDate" value="<?php if($toDate): echo $toDate;endif; ?>"type="date" class="form-control" placeholder="To Date">
              </div>
              <div class="form-group">
                  <label>Semester Name</label><br>
                <?php 
                echo form_dropdown('sections_name', $sections, $sectionId,'class="form-control" id="my_id" required="required"');
                ?>
              </div>
            <div class="form-group"><br>
                <button type="submit" name="search" value="search" class="btn btn-theme"><i class="fa fa-search"></i> Search</button>
                <button type="button" name="print" value="print" onclick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print </button>
            </div>
            </div>
          </div>
         <?php echo form_close(); ?>
        <?php if(@$result): ?>      
            <h3 class="has-divider text-highlight">Result :<?php echo $countResult?></h3>
            <div id="div_print">
                <h3 align="center"><?php echo $ReportName;?></h3>
            <table class="table  table-boxed table-bordered table-striped">
              <thead>
                 <tr style="font-size:15px;font-weight:bold" align="center">
                  <td rowspan="2" style="width:25px;">#</td>
                  <td rowspan="2" style="width:40px;">Colg#</td>
                  <td rowspan="2" style="width:180px;">Name</td>
                <?php
                if(!empty($subject)):
                    foreach($subject as $secRow):?> 
                <td><small><?php echo $secRow->title; ?></small></td>
                 <?php 
                    endforeach; 
                    endif;
                 ?>
                <td rowspan="2">Attd.<br>Lecs</td>
                <td rowspan="2">Total<br>Lecs</td>
                <td rowspan="2">%Age</td>     
                </tr>
                <tr style="font-size:15px;font-weight:bold" align="center">
                <?php 
                if(!empty($subject)):
                foreach($subject as $secRow):?>
                    <td align="center">P/T</td>
                <?php 
                endforeach;
                endif;
                ?>
            </tr> 
              </thead>
              <tbody>    
            <?php
                $sn = 1;
                $Attend_class = "";
                $Absent_class = "";  
                $total_class = "";  
               foreach($result as $resRow):
            ?>
              <tr>
                <td><?php echo $sn;?></td>
                <td align="center"><?php echo $resRow->college_no;?></td>
                <td><?php echo $resRow->student_name;?></td>
                <?php 
            if(!empty($subject)):
            foreach($subject as $secRow):
                echo '<td align="center">';
                $where = array(
                    'subject_id'    => $secRow->subject_id,
                    'sec_id'        => $secRow->sec_id,
                    'student_id'    =>$resRow->student_id
                    );
          //  ECHO '<pre>';print_r($where);
            $q = $this->AttendanceModel->get_studentbcs_att($where,$fromDate,$toDate);
                            $p=0;
                            $a=0;
                            $t=0;
                            foreach($q as $r):
                                if($r->status == 1):
                                    $p++;
                                    else:
                                    $a++;
                                endif;
                              endforeach;
                            $t = $p + $a;
                            echo $p.'/';
                            echo $t;
                            $Attend_class += $p;
                            $Absent_class += $a;
                echo '</td>'; 
                endforeach;
                endif;
            ?> 
            <td align="center"><?php echo $Attend_class; ?></td>    
            <td align="center"><?php echo $t = $Absent_class + $Attend_class; ?></td>    
            <td align="center"><?php if(!empty($t)): echo round($Attend_class*100/$t,1); else: echo '0';endif;?>%</td>      
              </tr>     
            <?php
              $sn++;
            $Attend_class = "";
            $Absent_class = "";
            endforeach;
          ?>
              </tbody>
            </table>
            <?php
            else:
                echo '';
            endif;
             echo $print_log;?>
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
 
 
  
  
            