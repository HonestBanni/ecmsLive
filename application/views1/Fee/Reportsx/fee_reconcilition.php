

<style>

.report_header{
    display: none !important;
}
 
</style>

<script language="javascript">
  function printdiv(printpage)
  {
    var headstr = "<html><head><title></title></head><body>";
//    var headstr = "<html><head><title></title></head><body><p><img  class='img-responsive' src='assets/images/logo.png' alt='Edwardes College Peshawar'></p>";
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
            <h1 class="heading-title pull-left"><?php echo $page_header?></h1>
                <div class="breadcrumbs pull-right">
                    <ul class="breadcrumbs-list">
                        <li class="breadcrumbs-label">You are here:</li>
                        <li><?php echo anchor('admin/admin_home', 'Home');?> 
                          <i class="fa fa-angle-right">
                          </i>
                        </li>
                        <li class="current"><?php echo $page_header?></li>
                    </ul>
                </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
        
        
        
        
        
      <div class="row">
          <div class="col-md-12">
              <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line"><?php echo $page_header?> Panel</span>
                        </h1>
                        <div class="section-content" >
                           <?php echo form_open('',array('class'=>'course-finder-form'));
                                  
                                     ?>
                                <div class="row">
                                <div class="col-md-2 col-sm-5">
                                          <label for="name">College #</label>
                                        
                                         
                                                <?php
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'collegeNo',
                                                                'type'          => 'number',
                                                                'value'         => $collegeNo,
                                                                'class'         => 'form-control',
                                                                'placeholder'   => 'College #',
                                                                 )
                                                             );
                                                      ?>
                                           
                                            
                                     </div>
                                <div class="col-md-2 col-sm-5">
                                          <label for="name">Name</label>
                                        
                                           
                                                <?php
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'stdName',
                                                                'type'          => 'text',
                                                                'value'         => $stdName,
                                                                'class'         => 'form-control',
                                                                'placeholder'   => 'Student Name',
                                                                 )
                                                             );
                                                      ?>
                                           
                                            
                                     </div>
                                <div class="col-md-2 col-sm-5">
                                          <label for="name">Father Name</label>
                                        
                                         
                                                <?php
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'fatherName',
                                                                'type'          => 'text',
                                                                'value'         => $fatherName,
                                                                'class'         => 'form-control',
                                                                'placeholder'   => 'Father Name',
                                                                 )
                                                             );
                                                      ?>
                                            
                                            
                                     </div>
                                    
                                <div class="col-md-2">
                                    <label for="name">Program</label>
                                    <div class="form-group ">
                                        <?php 
                                            echo form_dropdown('programe_id', $program,$programe_id,  'class="form-control programe_id" id="feeProgrameId"');
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="name">Sub Program</label>
                                    <div class="form-group ">
                                        <?php 
//                                        $sub_program = array('Sub Program'=>"Sub Program");
                                                echo form_dropdown('sub_pro_id', $sub_program,$sub_pro_id,  'class="form-control sub_pro_id" id="showFeeSubPro"');
                                        ?>
                                    </div>
                                </div> 
                                <div class="col-md-2">
                                    <label for="name">Section</label>
                                    <div class="form-group ">
                                        <?php 
//                                        $Section = array('Section'=>"Section");
                                                echo form_dropdown('section', $section,$sec_id,  'class="form-control section" id="showSections"');
                                        ?>
                                    </div>
                                </div> 
                                 
                                <div class="col-md-2">
                                    <label for="name">From</label>
                                    <div class="form-group ">
                                        <?php 
                                             echo  form_input(
                                                             array(
                                                                'name'          => 'from',
                                                                'type'          => 'text',
                                                                'value'         => $from,
                                                                'class'         => 'form-control datepicker',
                                                                
                                                                 )
                                                             );
                                        ?>
                                    </div>
                                </div> 
                                <div class="col-md-2">
                                    <label for="name">To</label>
                                    <div class="form-group ">
                                        <?php 
                                                echo  form_input(
                                                        array(
                                                           'name'          => 'to',
                                                           'value'         => $to,
                                                           'class'         => 'form-control datepicker',

                                                            )
                                                             );?>
                                    </div>
                                </div> 
                              
                           </div><!--//section-content-->
                                     
                                 
                          <div style="padding-top:1%;">
                                <div class="col-md-9 pull-right">
                                    
                                    <button type="submit" class="btn btn-theme" name="student_wise" id="student_wise"  value="student_wise" ><i class="fa fa-search"></i> Student Wise</button>
                                    <button type="submit" class="btn btn-theme" name="date_wise" id="date_wise"  value="date_wise" ><i class="fa fa-search"></i> Date Wise</button>
                                    <button type="submit" class="btn btn-theme" name="fee_head" id="fee_head"  value="fee_head" ><i class="fa fa-search"></i> Fee Head Section</button>
                                    <button type="submit" class="btn btn-theme" name="head_wise_student" id="head_wise_student"  value="head_wise_student" ><i class="fa fa-search"></i> Fee Head Student</button>
                                    <button type="button" name="print" value="print" onclick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print</button>
                                    <button type="reset" class="btn btn-theme"  id="save"> Reset</button> 
     
                                </div>
                            </div>
                                    <?php
                                    echo form_close();
                                    ?>
                                
                             
                            
                        
                        
                        
                    </section>
           
                             <?php
                             
                             
                   if(!empty($result)):                      
        ?>
                <div id="div_print">
                <div class="row">
                <div class="col-md-10 col-md-offset-1"> 
                    <div class="report_header">
                      <img style="float: right; padding-right: 79px;"  class='img-responsive' src='assets/images/logo-black.png' alt='Edwardes College Peshawar'>
                      <h3 class="text-highlight" style=" text-align: center">Bank Reconciliation Statement</h3>
                     
                    </div>
                 
                  
                      <h4 class="text-highlight" style=" text-align: center"><?=$report_name?></h4>
                      <h5 style=" text-align: center">From : <?php echo $from?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;To: <?php echo $to?></h5>
                    <hr/>
                 
                                      
                  
                                       
                  <?php
                  // Student Wise Report
                  if($report_type == 'student_wise'):
            
                  
                  ?>
                  
                 
                  <div class="table-responsive">
                        <table class="table table-hover" id="table">
                              <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Challan#</th>
                                    <th>Collage#</th>
                                    <th>Student Name</th>
                                    <th>Program</th>
                                    <th>Sub program</th>
                                    <th>Group</th>
                                    <th>Batch</th>
                                    <th>Paid</th>
                                    <th>Date</th>
                                    <th>Comments</th>
                                </tr>
                              </thead>
                              <tbody> 
                                  <?php
                                  $sn = "";
                                  $grandTotal = '';
                                    foreach($result as $row):
                                    $sn++;
                                    echo '<tr">
                                          <td>'.$sn.'&nbsp;&nbsp;&nbsp;</td>
                                          <td>'.$row->fc_challan_id.'</td>
                                          <td>'.$row->college_no.'</td>
                                          <td>'.$row->student_name.'</td>
                                          <td>'.$row->programe_name.'</td>
                                          <td>'.$row->sub_program_name.'</td>
                                          <td>'.$row->sessionName.'</td>
                                          <td>'.$row->batch_name.'</td>
                                          <td>'.$row->total_sum.'</td>
                                          <td>'.date('d-m-Y', strtotime($row->challan_paid_date)).'</td>
                                          <td>'.$row->fc_comments.'</td>

                                      </tr>';
                                   $grandTotal += $row->total_sum;
                                    endforeach;      
                                    ?>

                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><?=$grandTotal?></td>
                                    <td></td>
                                    <td></td>

                                </tr>

                              </tbody>
                      </table>
                  </div> 
                  
                    <?php
                  
                  endif;
                    if($report_type == 'date_wise'):
                    ?>
                    
                    <div class="table-responsive">
                        <table class="table table-hover" id="table">
                              <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    
                                    
                                </tr>
                              </thead>
                              <tbody> 
                                  <?php
                                  $sn = "";
                                  $grandTotal = '';
                                    foreach($result as $row):
                                    $sn++;
                                    echo '<tr">
                                          <td>'.$sn.'&nbsp;&nbsp;&nbsp;</td>
                                          <td>'.date('d-m-Y', strtotime($row->challan_paid_date)).'</td>
                                          <td>'.$row->total_sum.'</td>
                                          
                                       

                                      </tr>';
                                   $grandTotal += $row->total_sum;
                                    endforeach;      
                                    ?>

                                <tr>
                                    
                                    <td></td>
                                    <td></td>
                                    <td><?=$grandTotal?></td>
                                    

                                </tr>

                              </tbody>
                      </table>
                  </div> 
                    
                    <?php 
                    endif;
                    // Head Wise Section report 
                    if($report_type == 'head_wise'):
                    ?>
                    
                    <div class="table-responsive">
                        <table class="table table-hover" id="table">
                              <thead>
                                <tr>
                                    <th>Fee Head</th>
                                    <th></th>
                                    <th>Amount</th>
                                 </tr>
                              </thead>
                              <tbody> 
                                  <?php
                                  $sn = "";
                                  $grandTotal = '';
                                    foreach($result as $row):
                                        $where['fee_heads.fh_Id'] = $row->fh_Id;
                                         
                                    $date = array(
                                            'from'=>$from,
                                            'to'=>$to,
                                        ); 
                                   
                                    $fee_amount = $this->FeeModel->fee_bank_reconcilition_head_wise_section($where,$date);  
                                        echo '
                                        <tr">
                                            <td>'.$row->fh_head.'</td>
                                            <td> </td>
                                            <td> </td>
                                        </tr>';
                                    $Total = '';
                                    foreach($fee_amount as $feeRow):
                                        
                                   
                                    echo '<tr">
                                          
                                          <td> </td>
                                          <td>'.$feeRow->programe_name.'&nbsp;&nbsp;'.$feeRow->sessionName.'&nbsp;&nbsp;'.$feeRow->batch_name.'</td>
                                          <td>'.$feeRow->paid_amount.'</td>
                                          
                                       </tr>';
                                    $Total +=$feeRow->paid_amount;
                                    endforeach;
                                    echo '   <tr>
                                    
                                    <td></td>
                                    <td><strong>Total</strong></td>
                                    <td><strong>'.$Total.'</strong></td>
                                    

                                </tr>';
                                    $grandTotal +=$Total;
                                    endforeach;      
                                    ?>

                              <tr>
                                    
                                    <td></td>
                                    <td><strong>Grand Total</strong></td>
                                    <td><strong><?php echo $grandTotal?></strong></td>
                                    

                                </tr>

                              </tbody>
                      </table>
                  </div> 
                    
                    <?php 
                    endif;
                    
                     if($report_type == 'head_wise_student'):
                    ?>
                    
                    <div class="table-responsive">
                        <table class="table table-hover" id="table">
                              <thead>
                                <tr>
                                    <th>Fee Head</th>
                                    <th>Colleget No</th>
                                    <th>Student Name</th>
                                    <th>Group</th>
                                    <th>Amount</th>
                                 </tr>
                              </thead>
                              <tbody> 
                                  <?php
                                  $sn = "";
                                  $grandTotal = '';
                                    foreach($result as $row):
                                        $where['fee_heads.fh_Id'] = $row->fh_Id;
                                          $date = array(
                                            'from'=>$from,
                                            'to'=>$to,
                                        ); 
                                    $fee_amount = $this->FeeModel->fee_bank_reconcilition_head_wise_student($where,$date);  
                                        echo '
                                        <tr">
                                            <td>'.$row->fh_head.'</td>
                                            <td> </td>
                                            <td> </td>
                                            <td> </td>
                                            <td> </td>
                                        </tr>';
                                    $Total = '';
                                    foreach($fee_amount as $feeRow):
                                        
                                   
                                    echo '<tr">
                                          
                                          <td> </td>
                                           <td>'.$feeRow->college_no.'</td>
                                          <td>'.$feeRow->student_name.'</td>
                                          <td>'.$feeRow->sessionName.'&nbsp;&nbsp;'.$feeRow->batch_name.'</td>
                                          <td>'.$feeRow->paid_amount.'</td>
                                          
                                       </tr>';
                                    $Total +=$feeRow->paid_amount;
                                    endforeach;
                                    echo '   <tr>
                                    
                                    <td></td>
                                    <td> </td>
                                    <td> </td>
                                    <td><strong>Total</strong></td>
                                    <td><strong>'.$Total.'</strong></td>
                                    

                                </tr>';
                                    $grandTotal +=$Total;
                                    endforeach;      
                                    ?>

                              <tr>
                                    
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><strong>Grand Total</strong></td>
                                    <td><strong><?php echo $grandTotal?></strong></td>
                                    

                                </tr>

                              </tbody>
                      </table>
                  </div> 
                    
                    <?php 
                    endif;
                  ?>
                  
                  
                </div>
                </div>
                                  
                                </div>
                <?php  endif ?>
                                  
                                </div>
 
          </div>
          
      
      </div>
                 </div>
                
    
      
        <!--//page-row-->
      </div>
 
    <!--//page-wrapper--> 
 
   
   
     <script>
  $( function() {
    $( ".datepicker" ).datepicker({
        numberOfMonths: 3,
        dateFormat: 'dd-mm-yy'
    });
  } );
  </script>
  <style>
      .datepicker{
          z-index: 5;
      }
  </style>     
  
 