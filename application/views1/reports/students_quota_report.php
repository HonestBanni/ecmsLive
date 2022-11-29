<style>
    input[type=checkbox]{
    zoom: 1.5;
    }
</style>

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
            <div class="col-md-12">
          <div class="form-group">
            <?php 
                echo form_dropdown('program', $program, $programId,  'class="form-control" id="SProgrameId"');
            ?>
          </div>
        <div class="form-group">
        <?php 
    echo form_dropdown('batch', $batch, $batchId, 'class="form-control" id="showingbatch_id"');
        ?>
        </div>
        <div class="form-group">
            <?php 
       echo form_dropdown('s_status_id', $status, $application_statusId, 'class="form-control"');
            ?>
          </div>        
        <div class="form-group">
            <button type="submit" name="submit" value="Search" class="btn btn-theme">
                <i class="fa fa-search">
              </i> Search
            </button>
          </div>
               
            </div>
          </div>
             <?php echo form_close();
            
            if(@$result):
            ?>
            <p><button type="button" class="btn btn-success">
                <i class="fa fa-check-circle"></i>Total Records: <?php echo count($result)?>
            </button></p>
            
            <table class="table table-boxed table-hover table-bordered">
              <thead>
                <tr>    
                  <th>Sub Program</th>
                  <th>Open Merit</th>
                  <th>Minority</th>
                  <th>O-Level</th>
                  <th>Hafiz e Quran</th>
                  <th>Disable</th>
                  <th>Edwardes School</th>
                  <th>FATA</th>
                  <th>Sports</th>
                  <th>Girls</th>
                  <th>Staff Child</th>
                  <th>Balochistan </th>
                  <th>Other Province </th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                  <?php
            $openTotal = '';
            $minTotal = '';
            $olevelTotal = '';
            $hafizTotal = '';
            $disableTotal = '';
            $girlTotal = '';
            $sportsTotal = '';
            $fataTotal = '';
            $edwardesTotal = '';
            $sportsTotal = '';
            $balochTotal = '';
            $staff_childTotal = '';
            $otherTotal = '';
            $total = '';
            $grandTotal = '';
          foreach($result as $resRow):  
                $sup_pro_id = $resRow->sub_pro_id;
                ?>
              <tr>
                <td><?php echo $resRow->sub_program;?></td>
                <td><?php 
              $sup_pro_id = $resRow->sub_pro_id;
              $batch_id = $resRow->batch_id;
              $where = array('sub_pro_id'=>$sup_pro_id,'batch_id'=>$batch_id,'rseats_id'=>1);
             $open = $this->CRUDModel->get_where_result('student_record',$where); 
            $openTotal += $countopen = count($open);          
              echo $countopen;
              
                      ?></td>
                  <td><?php 
              $where1 = array('sub_pro_id'=>$sup_pro_id,'batch_id'=>$batch_id,'rseats_id'=>2);
             $min = $this->CRUDModel->get_where_result('student_record',$where1); 
               $minTotal+= $countmin = count($min);      
                echo $countmin;?></td>
                  <td><?php 
              $where2 = array('sub_pro_id'=>$sup_pro_id,'batch_id'=>$batch_id,'rseats_id'=>3);
             $olevel = $this->CRUDModel->get_where_result('student_record',$where2); 
            $olevelTotal += $countolevel = count($olevel);      
                echo $countolevel;?></td>
                  <td><?php 
              $where3 = array('sub_pro_id'=>$sup_pro_id,'batch_id'=>$batch_id,'rseats_id'=>4);
             $hafiz = $this->CRUDModel->get_where_result('student_record',$where3); 
              $hafizTotal += $counthafiz = count($hafiz);
                echo $counthafiz;?></td>
                  <td><?php 
              $where4 = array('sub_pro_id'=>$sup_pro_id,'batch_id'=>$batch_id,'rseats_id'=>5);
             $disable = $this->CRUDModel->get_where_result('student_record',$where4); 
              $disableTotal += $countdisable =  count($disable);
                echo $countdisable;   ?></td>
                  <td><?php 
              $where5 = array('sub_pro_id'=>$sup_pro_id,'batch_id'=>$batch_id,'rseats_id'=>6);
             $edwardes = $this->CRUDModel->get_where_result('student_record',$where5); 
              $edwardesTotal += $countedwardes = count($edwardes);
                echo $countedwardes;?></td>
                  <td><?php 
              $where6 = array('sub_pro_id'=>$sup_pro_id,'batch_id'=>$batch_id,'rseats_id'=>7);
             $fata = $this->CRUDModel->get_where_result('student_record',$where6); 
              $fataTotal += $countfata  = count($fata);
                echo  $countfata;  ?></td>
                  <td><?php 
              $where7 = array('sub_pro_id'=>$sup_pro_id,'batch_id'=>$batch_id,'rseats_id'=>9);
             $sports = $this->CRUDModel->get_where_result('student_record',$where7); 
              $sportsTotal += $countsports =  count($sports);
                echo  $countsports;     ?></td>
                  <td><?php 
              $where8 = array('sub_pro_id'=>$sup_pro_id,'batch_id'=>$batch_id,'rseats_id'=>11);
             $girl = $this->CRUDModel->get_where_result('student_record',$where8); 
              $girlTotal += $countgirl = count($girl);
                echo $countgirl;   ?></td>
                  <td><?php 
             $where9 = array('sub_pro_id'=>$sup_pro_id,'batch_id'=>$batch_id,'rseats_id'=>12);
             $staff_child = $this->CRUDModel->get_where_result('student_record',$where9); 
              $staff_childTotal += $countstaff_child = count($staff_child);
                echo $countstaff_child; ?></td>
                  <td><?php 
              $where10 = array('sub_pro_id'=>$sup_pro_id,'batch_id'=>$batch_id,'rseats_id'=>13);
             $baloch = $this->CRUDModel->get_where_result('student_record',$where10); 
              $balochTotal += $countbaloch = count($baloch);
                echo  $countbaloch; ?></td>
                  <td><?php 
              $where11 = array('sub_pro_id'=>$sup_pro_id,'batch_id'=>$batch_id,'rseats_id'=>8);
             $other = $this->CRUDModel->get_where_result('student_record',$where11); 
              $otherTotal += $countother = count($other);
                echo $countother; ?></td>
                  <td style="font-size:15px; color:green"><?php $total = $countopen += $countmin += $countolevel += $counthafiz += $countdisable += $countedwardes += $countfata += $countsports += $countgirl += $countstaff_child += $countbaloch += $countother; echo  $total;?> </td>  
                  
          </tr>
                  <?php
//                  $openTotal += $countopen;
//                  $minTotal += $countmin;
//                 $olevelTotal += $countolevel;
//                  $hafizTotal += $counthafiz;
//                  $disableTotal += $countdisable;
//                  $edwardesTotal += $countedwardes;
//                  $fataTotal += $countfata;
//                  $sportsTotal += $countsports;
//                  $girlTotal += $countgirl;
//                  $staff_childTotal += $countstaff_child;
//                  $balochTotal += $countbaloch;
//                  $otherTotal += $countother;
                  endforeach;
                ?>
                  <tr style="font-size:15px; color:green">
                    <td>Grand Total</td>
                    <td><?php echo $openTotal;?></td>
                    <td><?php echo $minTotal;?></td>
                    <td><?php echo $olevelTotal;?></td>
                    <td><?php echo $hafizTotal;?></td>
                    <td><?php echo $disableTotal;?></td>
                    <td><?php echo $edwardesTotal;?></td>
                    <td><?php echo $fataTotal;?></td>
                    <td><?php echo $sportsTotal;?></td>
                    <td><?php echo $girlTotal;?></td>
                    <td><?php echo $staff_childTotal;?></td>
                    <td><?php echo $balochTotal;?></td>
                    <td><?php echo $otherTotal;?></td>
                    <td></td>
                  </tr>
              </tbody>
            </table> 
            <?php
            else:
                echo '<h3 class="has-divider text-highlight">No query found..</h3>';
            endif;
            ?>
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
 
 