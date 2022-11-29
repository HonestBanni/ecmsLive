<style>

.report_header{
    display: none !important;
}
 
</style>

<script language="javascript">
  function printdiv(printpage)
  {
//    var headstr = "<html><head><title></title></head><body>";
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
                                      <label for="name">Form #</label>

                                       <div class="input-group" id="adv-search">
                                            <?php
                                                echo  form_input(
                                                         array(
                                                            'name'          => 'form_no',
                                                            'type'          => 'text',
                                                            'value'         => $form_no,
                                                            'class'         => 'form-control',
                                                            'placeholder'   => 'Form No #',
                                                             )
                                                         );
                                                  ?>
                                          </div>

                                 </div>

                                <div class="col-md-2 col-sm-5">
                                          <label for="name">College #</label>
                                        
                                           <div class="input-group" id="adv-search">
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
                                            
                                     </div>
                                
                                <div class="col-md-2 col-sm-5">
                                          <label for="name">Name</label>
                                        
                                           <div class="input-group" id="adv-search">
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
                                            
                                     </div>
                                <div class="col-md-2 col-sm-5">
                                          <label for="name">Father Name</label>
                                        
                                           <div class="input-group" id="adv-search">
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
                                            
                                     </div>
                                    <div class="col-md-2">
                                    <label for="name">Gender</label>
                                    <div class="form-group ">
                                        <?php 
//                                        $Section = array('Section'=>"Section");
                                                echo form_dropdown('gender', $gender,$gender_id,  'class="form-control" ');
                                        ?>
                                    </div>
                                </div> 
                                <div class="col-md-2">
                                    <label for="name">Program</label>
                                    <div class="form-group ">
                                        <?php 
                                            echo form_dropdown('programe_id', $program,$programe_id,  'class="form-control programe_id" id="feeProgrameId"');
                                        ?>
                                    </div>
                                </div>

                                        </div>
                            <div class="row">   
                                
                                
                         
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
                                    <label for="name">Batch</label>
                                    <div class="form-group ">
                                        <?php
                                            
                                            echo form_dropdown('batch_id', $batch_name,$batch_id,'class="form-control  " id="batch_id"');
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
                                    <label for="name">Student Status</label>
                                    <div class="form-group ">
                                        <?php 
//                                        $Section = array('Section'=>"Section");
                                                echo form_dropdown('std_status', $student_status,$student_status_id,  'class="form-control" ');
                                        ?>
                                    </div>
                                    </div> 
                                <div class="col-md-2 col-sm-5">
                                          <label for="name">Due Date From</label>
                                        
                                           <div class="input-group" id="adv-search">
                                                <?php
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'dueDateFrom',
                                                                'type'          => 'text',
                                                                'value'         => $dueDateFrom,
                                                                'class'         => 'form-control datepicker',
                                                                'placeholder'   => 'Due Date From',
                                                                 )
                                                             );
                                                      ?>
                                              </div>
                                            
                                     </div>
                                <div class="col-md-2 col-sm-5">
                                          <label for="name">Due Date To</label>
                                        
                                           <div class="input-group" id="adv-search">
                                                <?php
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'dueDateTo',
                                                                'type'          => 'text',
                                                                'value'         => $dueDateTo,
                                                                'class'         => 'form-control datepicker',
                                                                'placeholder'   => 'Due Date To',
                                                                 )
                                                             );
                                                      ?>
                                              </div>
                                            
                                     </div>

                                 
                            </div>
                              
                           </div><!--//section-content-->
                                     
                                 
                          <div style="padding-top:1%;">
                                <div class="col-md-3 pull-right">
                                    
                                    <button type="submit" class="btn btn-theme" name="filter" id="filter"  value="filter" ><i class="fa fa-search"></i> Search</button>
                                    <button type="button" name="print" value="print" onclick="printdiv('div_print');" class="btn btn-theme"><i class="fa fa-print"></i> Print</button>    
                                    
     
                                </div>
                            </div>
                                    <?php
                                    echo form_close();
                                    ?>
                    </section>
              
          
                             <?php
                    if(!empty($result)):                      
                    echo ' <div class="row">
                            <div class="col-md-12 ">';
                                echo '<div id="div_print">
                                    <div class="report_header">
                                        <h3 class="text-highlight" style=" text-align: center">D-Notice Defaulter List</h3>
                                    </div>
                                    <h3 class="has-divider text-highlight">Result :'; echo count($result); echo '</h3>
                                         
                                              <table class="table table-hover" id="table" style="font-size:11px">
                                                    <thead>
                                                      <tr>

                                                          <th>#</th>
                                                          <th>College</th>
                                                          <th>Student Name</th>
                                                          <th>Father Name</th>
                                                          <th>Class</th>
                                                          <th>Batch</th>
                                                          <th>Due-Amt</th>
                                                          <th>Paid-Amt</th>
                                                          <th>Bal-Amt</th>
                                                          <th>Issue-Date</th>
                                                          <th>Due-Date</th>
                                                          <th>Attent %</th>
                                                         <th>Marks %</th>
                                                         
                                                          

                                                      </tr>
                                                    </thead>
                                                    <tbody>';

                                                        $sn = "";
                                                        $gTotalDue = ''; 
                                                        $gTotalPaid = ''; 
                                                        $gTotalBalanace = ''; 
                                                          foreach($result as $row):
                                                              
                                                              $sn++;
                                                        
                                                           echo '<tr>
                                                                <td>'.$sn.'</td>
                                                                <td>'.$row->college_no.'</td>
                                                                <td>'.substr($row->student_name, 0, 15).'</td>
                                                                <td>'.$row->father_name.'</td>';
                                                               $group = ''; 
                                                           
                                                                          $this->db->join('sections','sections.sec_id=student_promotion_alumni_details.sec_id');  
                                                               $section = $this->db->get_where('student_promotion_alumni_details',array('student_promotion_alumni_details.sub_pro_id'=>$row->sub_pro_id,'student_id'=>$row->student_id))->row();
                                                                   
//                                                                                    $this->db->order_by('fc_challan_id','desc');
                                                                                   
                                                               
                                                               
                                                           if($row->Group):
                                                               $group = $row->Group;
                                                               else:
                                                                  if($section):
                                                                      $group = $section->name;
                                                                  endif; 
                                                               
//                                                                   $group = ''; 
                                                           endif;
                                                           $amountpaid = '';
                                                            if(empty($last_paid_challan)):
                                                                $amountpaid = '';
                                                                else:
                                                                $amountpaid = $last_paid_challan->paidAmount;
                                                            endif;
                                                            echo '<td>'.$row->sub_program.' ('.$group.')</td>
                                                                <td>'.$row->prospectus_batch.'</td> 
                                                                <td>'.$row->noticeAmount.'</td>
                                                                <td></td><td></td>';
                                                                echo '<td>'.Date('d-m-Y',strtotime($row->print_date)).'</td>';                   
                                                                echo '<td>'.Date('d-m-Y',strtotime($row->due_date)).'</td>';                   
                                                                echo '<td>'.$row->attendance.'</td>    
                                                                <td>'.$row->marks.' %</td>    
                                                                        ';
                                                              echo '</tr>';
                                                                                    $this->db->select("
                                                                                             fc_challan_id, 
                                                                                             sum(paid_amount) as paidAmount,
                                                                                             fc_paiddate,
                                                                                             fc_comments,
                                                                                             ");
                                                                                     $this->db->order_by('fc_challan_id','desc');
//                                                                                     $this->db->group_by('fc_challan_id');
                                                                                     $this->db->join('fee_actual_challan_detail','fee_actual_challan_detail.challan_id=fee_challan.fc_challan_id');   
                                                                $last_paid_challan = $this->db->get_where('fee_challan',array('fc_student_id'=>$row->student_id,'fc_ch_status_id'=>2,'fc_paiddate >'=>$row->print_date))->result();
                                                                $this->db->select('
                                                                                            hostel_student_bill.id  as fc_challan_id,
                                                                                            sum(hostel_student_bill_info.paid_amount)  as paidAmount,
                                                                                            hostel_student_bill.payment_date  as fc_paiddate,
                                                                                            hostel_student_bill.comments  as fc_comments,
                                                                                        ');
                                                                                        $this->db->group_by('hostel_student_bill.id');
                                                                                        $this->db->join('hostel_student_bill','hostel_student_bill.hostel_std_id=hostel_student_record.hostel_id'); 
                                                                                        $this->db->join('hostel_student_bill_info','hostel_student_bill_info.hostel_bill_id=hostel_student_bill.id'); 
                                                                $hostel             =   $this->db->get_where('hostel_student_record',array('student_id'=>$row->student_id,'challan_status'=>2,'head_type'=>1,'payment_date>'=>$row->print_date))->result();
                                                                                        $this->db->select('
                                                                                            hostel_student_bill.id  as fc_challan_id,
                                                                                            sum(hostel_student_bill_info.paid_amount)  as paidAmount,
                                                                                            hostel_student_bill.payment_date  as fc_paiddate,
                                                                                            hostel_student_bill.comments  as fc_comments,
                                                                                            
                                                                                            ');
                                                                                        $this->db->group_by('hostel_student_bill.id');
                                                                                        $this->db->join('hostel_student_bill','hostel_student_bill.hostel_std_id=hostel_student_record.hostel_id'); 
                                                                                        $this->db->join('hostel_student_bill_info','hostel_student_bill_info.hostel_bill_id=hostel_student_bill.id'); 
                                                                $mess             =   $this->db->get_where('hostel_student_record',array('student_id'=>$row->student_id,'challan_status'=>2,'head_type'=>2,'payment_date>'=>$row->print_date))->result();
                                                                if(!empty($last_paid_challan)):
                                                                  echo '<tr>';
                                                                        echo '<td></td>';  
                                                                        echo '<td></td>';  
                                                                        echo '<td colspan="2"> </td>';  
                                                                        echo '<td><strong>Challan No</strong></td>';  
                                                                        echo '<td><strong>Paid Date</strong></td>';  
                                                                        echo '<td><strong></strong></td>';  
                                                                        echo '<td><strong></strong></td>';  
                                                                        echo '<td><strong></strong></td>';  
                                                                        echo '<td colspan="3"><strong>Comments</strong></td>';  
                                                                        echo '<td></td>';  
                                                                        echo '</tr>';
                                                                        $paidAmountF = '';
                                                                        $paidAmountH = '';
                                                                        $paidAmountM = '';
                                                                        $paidAmount = '';
//                                                                        $FeePaid = '';
                                                                foreach($last_paid_challan as $ddetails):
                                                                        echo '<tr>';
                                                                        echo '<td></td>';  
                                                                        echo '<td></td>';  
                                                                        echo '<td></td>';  
                                                                        echo '<td></td>';  
                                                                        echo '<td>'.$ddetails->fc_challan_id.'&nbsp;(Fee Chalan)</td>'; 
                                                                        if(empty($ddetails->fc_paiddate)):
                                                                            echo '<td></td>';
                                                                            else:
                                                                            echo '<td>'.Date('d-m-Y',strtotime($ddetails->fc_paiddate)).'</td>';
                                                                        endif;
                                                                        echo '<td></td>';
                                                                        echo '<td>'.$ddetails->paidAmount.'</td>';
                                                                        echo '<td></td>';
                                                                        echo '<td colspan="5">'.$ddetails->fc_comments.'</td>';
                                                                        
                                                                        echo '</tr>';
                                                                        $paidAmountF += $ddetails->paidAmount;
                                                                         
                                                                endforeach;
                                                                endif;
                                                                if(!empty($hostel)):
                                                                foreach($hostel as $hmess):
                                                                        echo '<tr>';
                                                                        echo '<td></td>';  
                                                                        echo '<td></td>';  
                                                                        echo '<td></td>';  
                                                                        echo '<td></td>';  
                                                                        echo '<td>'.$hmess->fc_challan_id.' &nbsp;(Hostel)</td>'; 
                                                                        if(empty($hmess->fc_paiddate)):
                                                                            echo '<td></td>';
                                                                            else:
                                                                            echo '<td>'.Date('d-m-Y',strtotime($hmess->fc_paiddate)).'</td>';
                                                                        endif;
                                                                        echo '<td></td>';
                                                                        echo '<td>'.$hmess->paidAmount.'</td>';
                                                                        echo '<td></td>';
                                                                        echo '<td colspan="5">'.$hmess->fc_comments.'</td>';
                                                                        
                                                                        echo '</tr>';
                                                                        $paidAmountH += $hmess->paidAmount;
                                                                         
                                                                endforeach;
                                                                 endif;
                                                                if(!empty($mess)):
                                                                foreach($mess as $ms):
                                                                        echo '<tr>';
                                                                        echo '<td></td>';  
                                                                        echo '<td></td>';  
                                                                        echo '<td></td>';  
                                                                        echo '<td></td>';  
                                                                        echo '<td>'.$ms->fc_challan_id.' &nbsp;(Mess)</td>'; 
                                                                        if(empty($ms->fc_paiddate)):
                                                                            echo '<td></td>';
                                                                            else:
                                                                            echo '<td>'.Date('d-m-Y',strtotime($ms->fc_paiddate)).'</td>';
                                                                        endif;
                                                                        echo '<td></td>';
                                                                        echo '<td>'.$ms->paidAmount.'</td>';
                                                                        echo '<td></td>';
                                                                        echo '<td colspan="5">'.$ms->fc_comments.'</td>';
                                                                        
                                                                        echo '</tr>';
                                                                        $paidAmountM += $ms->paidAmount;
                                                                endforeach;
                                                              endif;
                                                             $balace = '';
                                                             $paidAmount = $paidAmountF+$paidAmountH+$paidAmountM;
                                                             if($row->noticeAmount>0):
                                                                 $balace = $row->noticeAmount-$paidAmount;
                                                                 else:
                                                                 $balace = $row->noticeAmount;    
                                                             endif;
                                                             
                                                              $balaceS = '';
                                                              $balaceS = $balace;
//                                                              if($balace <0):
//                                                                  $balaceS = '' ;
//                                                                  else:
//                                                                  $balaceS = $balace;
//                                                              endif;
                                                                        echo '<tr>';
                                                                        echo '<td colspan="5"></td>';  
                                                                        echo '<td></td>';
                                                                        echo '<td></td>';
                                                                        echo '<td></td>';
                                                                        echo '<td> '.$balaceS.'</td>';     
//                                                                        echo '<td> '.$row->noticeAmount.'-'.$paidAmount.' = '.$balaceS.'</td>';     
                                                                        echo '<td></td>';     
                                                                        echo '<td></td>';     
                                                                        echo '<td></td>';     
                                                                        echo '<td></td>';     
                                                                        echo '</tr>';
                                                                        
                                                                   $gTotalDue += $row->noticeAmount;     
                                                                   $gTotalPaid += $paidAmount;     
                                                                   $gTotalBalanace += $balaceS;   
                                                                    
                                                          endforeach;      
                                                          echo '<tr>';
                                                          echo '<td colspan="5"></td>';
                                                          echo '<td>Grand Total</td>';
                                                          echo '<td>'.$gTotalDue.'</td>';
                                                          echo '<td>'.$gTotalPaid.'</td>';
                                                          echo '<td>'.$gTotalBalanace.'</td>';
                                                          echo '<td colspan="4"></td>';
                                                          echo '</tr>';
                                                    echo'</tbody>
                                            </table>
                                         ';
                                          
                                 echo $print_log;
                                    
                                    echo '</div>
                                    </div>
                                  
                                </div>';
                                  endif;
                             
                             ?>
                                  
                                </div>
                        </div>
                    </div>
                </div>
            </div>
 
<script>

    $( function() {
    $( ".datepicker" ).datepicker({
         changeMonth: true,
        changeYear: true,
         dateFormat: 'dd-mm-yy'
    });
  } );
</script>
   
   
 
     
  
 
    
    
    