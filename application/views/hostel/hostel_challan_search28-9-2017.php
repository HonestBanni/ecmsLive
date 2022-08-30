 

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
                                <div class="col-md-2">
                                    <label for="name">Form#</label>
                                        <?php 
                                            echo form_input(array(
                                                'name'          => 'form_no',
                                                'id'            => 'form_no',
                                                'value'         => $form_no,
                                                'placeholder'   => 'Enter Form No',
                                                'class'         => 'form-control',
                                                ));
                                         
                                         ?>
                                    </div>
                               <div class="col-md-2">
                                    <label for="name">Challan No</label>
                                        <?php 
                                            echo form_input(array(
                                                'name'          => 'challan_no',
                                                'id'            => 'challan_no',
                                                'value'         => $challan_no,
                                                'placeholder'   => 'Enter Challan No',
                                                'class'         => 'form-control',
                                                ));
                                           
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
                                    <label for="name">Challan Status</label>
                                    <div class="form-group ">
                                        <?php 
                                            echo form_dropdown('hostel_head_type', $hostel_head_type,$hotel_type_id,  'class="form-control" id="hostel_status"  ');
                                        ?>
                                    </div>
                                </div>
                                    <div class="col-md-2">
                                    <label for="name">Hostel Status</label>
                                    <div class="form-group ">
                                        <?php 
                                            echo form_dropdown('hoste_p_status', $hoste_p_status,$hoste_p_status_id,  'class="form-control" ');
                                        ?>
                                    </div>
                                    </div>
                                    <div class="col-md-2">
                                    <label for="name">Installment Type</label>
                                    <div class="form-group ">
                                        <?php 
                                            echo form_dropdown('installment_type', $installment_type,$int_type_id,  'class="form-control" id="instal_type"');
                                        ?>
                                    </div>
                                    
                                    </div>
                                    <div class="col-md-2">
                                    <label for="name">Batch</label>
                                    <div class="form-group ">
                                        <?php 
                                            echo form_dropdown('batch', $batch,$batch_id,  'class="form-control" id="batch_id"');
                                        ?>
                                    </div>
                                    
                                    </div>
                                    
                           </div><!--//section-content-->
                                     
                                 
                          <div style="padding-top:1%;">
                                <div class="col-md-3 pull-right">
                                    
<!--                                    <button type="submit" class="btn btn-theme" name="conce_std_wise" id="conce_std_wise"  value="conce_std_wise" ><i class="fa fa-search"></i> Section Wise</button>
                                    <button type="submit" class="btn btn-theme" name="date_wise" id="date_wise"  value="date_wise" ><i class="fa fa-search"></i> Date Wise</button>-->
                                    <!--<button type="submit" class="btn btn-theme" name="conce_head_wise" id="conce_head_wise"  value="conce_head_wise" ><i class="fa fa-search"></i> Head Wises</button>-->
                                    <button type="submit" class="btn btn-theme" name="search" id="search"  value="search" ><i class="fa fa-search"></i> Search</button>
                                    <button type="button" name="print" value="print" id="print_challan"  class="btn btn-theme"><i class="fa fa-print"></i> Print</button>
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
                <div class="col-md-12"> 
                    
                       <?php
                  // Student Wise Report
                  if($report_type == 'hostel_std_search'): ?>
                    <div class="report_header">
                      <img style="float: right; padding-right: 79px;"  class='img-responsive' src='assets/images/logo-black.png' alt='Edwardes College Peshawar'>
                    
                      
                      
                    </div>
                        <h4 class="text-highlight" style=" text-align: center"><?=$report_name?></h4>
                        
                    <hr/>
          
                    <div class="table-responsive">
                        <table class="table table-hover" id="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Form#</th>
                                    <th>Collage#</th>
                                    <th>Student Name</th>
                                     
                                    <th>Class</th>
                                    <th>Group</th>
                                    <th>Hostel Status</th>
                                    <th>Payment Status</th>
                                    <th>Challan#</th>
                                    <th>Actual Amount</th>
                                    <th>Paid Amount</th>
                                    <th>Date</th>
                                    <th>Print</th>
                                    <th>Update</th>
                                    <th>Add Head</th>
                                </tr>
                            </thead>
                        <tbody> 
                            <?php
//                               echo '<pre>';print_r($result);die;
                            $sn = "";
                            $grandTotal = '';
                             $actual_amountTotal = '';
                              foreach($result as $row):
                              $sn++;
                                     
                              echo '<tr">
                                      <td>'.$sn.'&nbsp;&nbsp;&nbsp;</td>
                                      <td>'.$row->form_no.'</td>
                                      <td>'.$row->college_no.'</td>
                                      <td>'.$row->student_name.'</td>
                                       ';

//                                            <td>'.$row->sub_program_name.'&nbsp;&nbsp;'.$row->sessionName.'&nbsp;&nbsp;'.$row->batch_name.'</td>
                                      echo '<td>'.$row->sub_program_name.'</td><td>'.$row->sessionName.'</td>';

                                      echo '<td>'.$row->status_name.'</td><td>'.$row->fcs_title.'</td>';

//                                    echo '<pre>';print_r($where);die;
                                      $where['hostel_student_bill.id'] = $row->challan_id;
                                      $cons =   $this->HostelModel->get_hotel_amount($where); 
                                      echo ' <td>'.$row->challan_id.'</td><td>'.$cons->actual_amount.'</td><td>'.$cons->total_paid.'</td>';

                                    //Refund Amount
                                    $payment_date;
                                    if($row->payment_date == '0000-00-00'):
                                          $payment_date = ''; 
                                        else:
                                        $payment_date = date('d-m-Y',strtotime($row->payment_date));
                                    endif;
                                       echo '<td>'.$payment_date.'</td>
                                                    ';
                                                if($row->ch_status_id ==1):
                                                    echo '
                                                    <td><a href="hostelPrintChallan/'.$row->hostel_id.'/'.$row->challan_id.'" class="btn btn-success btn-xs" target="_new"><i class="fa fa-print"></i>Print<a></td>
                                                    <td><a href="hostelUpdateChallan/'.$row->hostel_id.'/'.$row->challan_id.'" class="btn btn-warning btn-xs" target="_new"><i class="fa fa-book"></i>Update<a></td>
                                                    <td><a href="hostelAddHead/'.$row->hostel_id.'/'.$row->challan_id.'" class="btn btn-danger btn-xs" target="_new"><i class="fa fa-print"></i>Add Head<a></td>';
                                            else:
                                                echo '<td></td>';
                                                echo '<td></td>';
                                                echo '<td></td>';
                                                endif;
                                                    
                                            echo '</tr>';
                                    $actual_amountTotal +=$cons->actual_amount;
                                    $grandTotal +=$cons->total_paid;


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
                               
                               
                              <td colspan="2">Grand Total</td>
                                 
                              <td><?php echo $actual_amountTotal?></td>
                              <td><?php echo $grandTotal?></td>
                              <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div> 
                   <?php  endif; ?>
                
                    
                  
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
  
 