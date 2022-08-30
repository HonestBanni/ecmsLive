 

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
                                    <div class="form-group">
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
                                    <label for="name">Hostel Type</label>
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
                        <table class="table table-hover" id="table" style="font-size:11px;">
                            <thead>
                                <tr>
                                    <th>#</th>
                                     
                                    <th>Form</th>
                                    <th>Collage#</th>
                                    <th>Student Name</th>
                                    <th>H.Status</th>
                                    <th>Inst#</th>
                                    <th>From / To Date</th>
                                    <th>Chln#</th>
                                    <th>Curt</th>
                                    <th>Arrs</th>
                                    <th>Paid</th>
                                    <th>Bale</th>
                                    <th>Date</th>
                                    <th>P.Status</th>
                                    <th>Print</th>
                                    <th>Cancel</th>
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
                             
                               
//                                 echo '<pre>';print_r($check_last_challan); 
                             
                              foreach($result as $row):
                               
                            $sn++;
                                  
                              echo '<tr">
                                      <td>'.$sn.'&nbsp;&nbsp;&nbsp;</td>
                                      
                                      <td>'.$row->form_no.'</td>
                                      <td>'.$row->college_no.'</td>
                                      <td><a href="fullDetails/'.$row->student_id.'" target="_new"><strong title="'.$row->student_name.'/'.$row->father_name.', Class :('.$row->sessionName.'), Student status = '.$row->student_status.'") target="_new">'.substr($row->student_name, 0, 15).'</strong></a><br/>'.$row->batch_name.'<br/>'.$row->sub_program_name.'<br/>'.$row->student_status.'</td>    
                                     
                                       ';
                                      
                                        
                                      echo '<td>'.$row->status_name.'</td>
                                             
                                              <td>'.$row->Category_title.'</td><td>'.date('d-M-y',  strtotime($row->date_from)).'<br/>'.date('d-M-y',  strtotime($row->date_to)).'</td>';
 
                                      
                                           echo  '<td>'.$row->challan_id.'</td><td style="font-weight: bold;color: red;">'.$row->current.'</td>
                                            <td>'.$row->arrears.'</td>
                                            <td>'.$row->paid.'</td>
                                            <td>'.$row->balance.'</td>
                                             ';
                                      

                                    //Refund Amount
                                    $payment_date;
                                    if($row->payment_date == '0000-00-00'):
                                          $payment_date = ''; 
                                        else:
                                        $payment_date = date('d-m-Y',strtotime($row->payment_date));
                                    endif;
                                       echo '<td>'.$payment_date.'</td>';
                                            if($row->ch_status_id ==1):
                                                echo ' <td>'.$row->fcs_title.'</td>'; 
                                                    if($row->challan_lock == 1):
                                                        echo '<td style="font-size:11px;"><a href="hostelPrintChallan/'.$row->hostel_id.'/'.$row->challan_id.'" class="btn btn-success btn-xs" target="_new"><i class="fa fa-print"></i>Print<a></td>';
                                                        echo '<td colspan="3">Challan Arrears shift to new challan</td>';
                                                        else:
                                                        echo '<td style="font-size:11px;"><a href="hostelPrintChallan/'.$row->hostel_id.'/'.$row->challan_id.'" class="btn btn-success btn-xs" target="_new"><i class="fa fa-print"></i>Print<a></td>
                                                              <td style="font-size:11px;"><a href="hostelCancelChallan/'.$row->challan_id.'/'.$row->hostel_id.'" class="btn btn-danger btn-xs" target="_new"><i class="fa fa-times"></i>Cancel<a></td>
                                                              <td style="font-size:11px;"><a href="hostelUpdateChallan/'.$row->hostel_id.'/'.$row->challan_id.'" class="btn btn-success btn-xs" target="_new"><i class="fa fa-book"></i>Update<a></td>
                                                              <td style="font-size:11px;"><a href="hostelAddHead/'.$row->hostel_id.'/'.$row->challan_id.'" class="btn btn-success btn-xs" target="_new"><i class="fa fa-print"></i>Add Head<a></td>';
                                                        endif;
                                            else:
                                                
                                                    $this->db->join('hostel_student_bill','hostel_student_bill.hostel_std_id=hostel_student_record.hostel_id');
                                                    $this->db->order_by('hostel_student_bill.id','desc');    
                                                    $this->db->limit('1',0);
                                                    $check_last_challan =   $this->db->get_where('hostel_student_record',array('student_id'=>$row->student_id,'challan_status'=>2,'hostel_student_bill.head_type'=>$hotel_type_id))->row();              
                                                   if(!empty($check_last_challan)):
                                                       
                                                       if($check_last_challan->id   == $row->challan_id):
                                                            
                                                       echo ' <td><button class="btn btn-success btn-xs last_challan" data-toggle="modal" data-target="#hostel_Challan_unpaid_model"  id="'.$check_last_challan->id.'" >'.$row->fcs_title.'</button></td>';
                                                           else:
                                                           echo ' <td>'.$row->fcs_title.'</td>';
                                                       endif;
                                                       
                                                       else:
                                                       echo ' <td>'.$row->fcs_title.'</td>';
                                                       
                                                   endif;
                                                                      
                                                
                                                echo '<td></td>';
                                                echo '<td></td>';
                                                echo '<td></td>';
                                                echo '<td></td>';
                                            endif;
                                                echo '</tr>';


                              endforeach;      
                                ?>
 
                        </tbody>
                    </table>
                </div> 
                   <?php  endif; ?>
                    </div>
                </div>
                <?php  endif ?>
             </div>
            </div>
       </div>
    </div>
      </div>
 
    <!--//page-wrapper--> 
<div class="modal fade" id="hostel_Challan_unpaid_model" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Unpaid Challan</h4>
        </div>
        <div class="modal-body">
            <input type="hidden" id="challan_id">
            <div id="uppaidChallanDetails">
                
            </div>
            <div class="form-group" id='challan_commentsDiv'>
                <label class="control-label" for="textarea-field">Unpaid Comments</label>
                <div class="alert alert-danger" role="alert" id='alert-danger'>
                    Please Enter Comments...
                </div>
                <textarea class="form-control" id="challan_comments"></textarea>
              </div>
             
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-theme" id='unpaidSave' >Unpaid</button>
          <button type="button" class="btn btn-theme" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>
   
   
     <script>
         
    jQuery(document).ready(function(){
        jQuery('#alert-danger').hide();
        jQuery('.last_challan').click(function(){
            var challan_id = jQuery(this).attr('id');
          jQuery.ajax({
                type        : 'post',
                url         : 'HosteChallanDetailsJS',
                async       : false,
                dataType    : 'json',
                data        : {'h_challan_id':challan_id},
                success: function(result){
                    jQuery('#challan_id').val(challan_id);
//                     jQuery("#hostel_Challan_unpaid_model").modal(); 
                  jQuery('#uppaidChallanDetails').html(result);
                  var html = '';
                  var i;
                   html += '<table class="table table-boxed table-bordered table-striped" id="table">'+
                        '<thead>'+
                          '<tr>'+
                              '<th>#</th>'+
                              '<th>Fee Head</th>'+
                              '<th>Current</th>'+
                              '<th>Arrears</th>'+
                              '<th>Paid</th>'+
                              '<th>Balance</th>'+
                            '</tr></thead>';
                    var current = '';
                    var arrear = '';
                    var totals = 0;
                    var tCurrent = 0;
                    var tArrear = 0;
                    var tbalance = 0;
                    var sn = 1;
                  for(i=0; i<result.length; i++){
                      if(result[i].old_challan_id == 0){
                            current = result[i].amount;
                            arrear = '0';
                            tCurrent+=parseFloat(current);
                        }else{
                            current = '0';
                            arrear  = result[i].amount;
                            tArrear +=parseFloat(arrear);
                      }
                      
                      html += '<tr>';
                        html += '<td>'+sn+'</td>';
                        html += '<td>'+result[i].title+'</td>';
                        html += '<td>'+current+'</td>';
                        html += '<td>'+arrear+'</td>';
                        html += '<td>'+result[i].paid_amount+'</td>';
                        html += '<td>'+result[i].balance+'</td>';
                        html += '</tr>';
                        sn++;
                        
                        totals +=  parseFloat(result[i].paid_amount);
                        tbalance +=  parseFloat(result[i].balance);
                  }
                  html += '<tr>';
                  html += '<td colspan="2"><strong>Total</strong></td>';
                  html += '<td><strong>'+tCurrent+'</strong></td>';
                  html += '<td><strong>'+tArrear+'</strong></td>';
                  html += '<td><strong>'+totals+'</strong></td>';
                  html += '<td><strong>'+tbalance+'</strong></td>';
                  
                  html += '<tbody></table>'+
                  jQuery('#uppaidChallanDetails').html(html);
              },
                      
          });
        });
        });
        jQuery('#unpaidSave').click(function(){
            
            var challan_id  = jQuery('#challan_id').val();
            var comments    = jQuery('#challan_comments').val();
           
           if(comments == ''){
               jQuery('#challan_commentsDiv').addClass('has-error');
               jQuery('#challan_comments').focus;
                 jQuery('#alert-danger').show();
               return false;
           }else{
               jQuery('#challan_commentsDiv').removeClass('has-error');
               jQuery('#alert-danger').hide();
           }
           jQuery.ajax({
                type        : 'post',
                url         : 'HosteChallanDetailsSaveJS',
                async       : false,
                dataType    : 'json',
                data        : {'h_challan_id':challan_id,'comments':comments},
                success: function(result){
                   document.location.reload();
 
                }
            });
           
        });
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
  
 