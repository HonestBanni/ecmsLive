

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
                                          <label for="name">Account Head</label>
                                        
                                         
                                                <?php
                                                    echo form_dropdown('fee_head_id', $fee_head,$fee_id,  'class="form-control"');
                                          
                                                      ?>
                                           
                                            
                                     </div>
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
<!--                                <div class="col-md-2 col-sm-5">
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
                                            
                                            
                                     </div>-->
                                    
                                <div class="col-md-2">
                                    <label for="name">Program</label>
                                    <div class="form-group ">
                                        <?php 
//                                            echo form_dropdown('programe_id', $program,$programe_id,  'class="form-control" ');
                                            echo form_dropdown('programe_id', $program,$programe_id,  'class="form-control programe_id" id="feeProgrameId"');
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="name">Sub Program</label>
                                    <div class="form-group ">
                                        <?php 
                                        
                                                echo form_dropdown('sub_pro_id', $sub_program,$sub_pro_id,  'class="form-control sub_pro_id" id="showFeeSubPro"');
//                                                echo form_dropdown('sub_pro_id', $sub_program,$sub_pro_id,  'class="form-control"');
                                        ?>
                                    </div>
                                </div> 
                                <div class="col-md-2">
                                    <label for="name">Batch</label>
                                    <div class="form-group ">
                                        <?php 
                                        
                                                echo form_dropdown('batch_name', $batch_name,$batch_id,  'class="form-control batch_id" id="batch_id"');
//                                                echo form_dropdown('sub_pro_id', $sub_program,$sub_pro_id,  'class="form-control"');
                                        ?>
                                    </div>
                                </div> 
                                <div class="col-md-2">
                                    <label for="name">Section</label>
                                    <div class="form-group ">
                                        <?php 
                                        
                                                echo form_dropdown('section', $section,$sec_id,  'class="form-control section" id="showSections"');
//                                                echo form_dropdown('section', $section,$sec_id,  'class="form-control"');
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
                                <div class="col-md-4">
                                    <label for="name">Bank</label>
                                    <div class="form-group ">
                                        <?php 
//                                        $Section = array('Section'=>"Section");
//                                                echo form_dropdown('section', $section,$sec_id,  'class="form-control section" id="showSections"');
                                                echo form_dropdown('bank', $bank,$bank_id,  'class="form-control"');
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="name">Gender</label>
                                    <div class="form-group ">
                                        <?php 
//                                        $Section = array('Section'=>"Section");
//                                                echo form_dropdown('section', $section,$sec_id,  'class="form-control section" id="showSections"');
                                                echo form_dropdown('gender', $gender,$gender_id,  'class="form-control"');
                                        ?>
                                    </div>
                                </div>
                              
                           </div><!--//section-content-->
                                     
                                 
                          <div style="padding-top:1%;">
                                <div class="col-md-4 pull-right">
                                    
<!--                                    <button type="submit" class="btn btn-theme" name="student_wise" id="student_wise"  value="student_wise" ><i class="fa fa-search"></i> Student Wise</button>
                                    <button type="submit" class="btn btn-theme" name="date_wise" id="date_wise"  value="date_wise" ><i class="fa fa-search"></i> Date Wise</button>
                                    <button type="submit" class="btn btn-theme" name="fee_head" id="fee_head"  value="fee_head" ><i class="fa fa-search"></i> Fee Head Group</button>-->
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
//                       echo '<pre>';print_r($result);die;
        ?>
                <div id="div_print">
                <div class="row">
                <div class="col-md-12"> 
                    <div class="report_header">
                      <img style="float: right; padding-right: 79px;"  class='img-responsive' src='assets/images/logo-black.png' alt='Edwardes College Peshawar'>
                      <h3 class="text-highlight" style=" text-align: center">Bank Reconciliation Statement</h3>
                     
                    </div>
                 
                  
                      <h4 class="text-highlight" style=" text-align: center"><?php echo $report_name?></h4>
                      <h4 class="text-highlight" style=" text-align: center"><?php echo $Bank_info?></h4>
                      <h5 style=" text-align: center">From : <?php echo $from?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;To: <?php echo $to?></h5>
                    <hr/>
                    
                    
                    <?php 
                  
                    
                     if($report_type == 'head_wise_student'):
                    ?>
                    
                    <div class="table-responsive">
                        <table class="table table-hover" id="table">
                              <thead>
                                <tr>
                                    <th>Fee Head</th>
                                    <th>College No</th>
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
                                           $date = array(
                                            'from'=>$from,
                                            'to'=>$to,
                                        ); 
                                       
//                                        $where['student_record.student_id'] = $row->fc_student_id;
                                        
                                        
                                        $where['fee_heads.fh_Id'] = $row->fh_Id;
//                                        $where['fee_actual_challan_detail.fee_id']  = $fee_id;
                                       
                                    $fee_amount = $this->FeeModel->fee_defaulter_details_head_wise_student($where,$like,$date);  
                                    
                                      
                                  
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
                                        if($feeRow->balance > 0):
                                            
                                        
                                            
                                   
                                    echo '<tr">
                                          
                                          <td> </td>
                                           <td>'.$feeRow->college_no.'</td>
                                          <td>'.strtoupper($feeRow->student_name).'</td>
                                          <td>'.$feeRow->sessionName.'&nbsp;&nbsp;'.$feeRow->batch_name.'</td>
                                          <td>'.$feeRow->balance.'</td>
                                           
                                          
                                       </tr>';
                                    $Total +=$feeRow->balance;
                                    endif;
                                    endforeach;
                                    
                                    
                                    
                                    echo '   <tr>
                                    
                                    <td></td>
                                    <td> </td>
                                    <td> </td>
                                    <td><strong>Total</strong></td>
                                    <td><strong>'.number_format($Total, 0, ',', ',').'</strong></td>
                                    

                                </tr>';
                                    $grandTotal +=$Total;
                                    endforeach; 
                                    
                                    
                                    $fee_amount_credit = $this->FeeModel->fee_bank_reconcilition_head_wise_student_credit($where2,$like,$date);  
                                   
                                    ?>

                              <tr>
                                    
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><strong>Total Credit </strong></td>
                                    <td><strong><?php echo number_format($fee_amount_credit->fc_challan_credit_amount, 0, ',', ',')?></strong></td>
                                    

                                </tr>
                              <tr>
                                    
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><strong>Grand Total</strong></td>
                                    <td><strong><?php echo number_format($grandTotal+$fee_amount_credit->fc_challan_credit_amount, 0, ',', ',')?></strong></td>
                                    

                                </tr>

                              </tbody>
                      </table>
                  </div> 
                    
                    <?php 
                    endif;
                  ?>
                  
                  
                </div>
                </div>
                  <?php echo $print_log;?>                
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
        numberOfMonths: 1,
        dateFormat: 'dd-mm-yy'
    });
  } );
  </script>
  <style>
      .datepicker{
          z-index: 5;
      }
  </style>     
  
 