 
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
                           <?php echo form_open('',array('class'=>'course-finder-form','id'=>'print_wise_form'));
                                  
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
                                      <label for="name">Challan #</label>

                                       <div class="input-group" id="adv-search">
                                            <?php
                                                echo  form_input(
                                                         array(
                                                            'name'          => 'challan_no',
                                                            'type'          => 'number',
                                                            'value'         => $challan_no,
                                                            'class'         => 'form-control',
                                                            'placeholder'   => 'Challan #',
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
                                        </div>
                            <div class="row">   
                                <div class="col-md-2">
                                    <label for="name">Program</label>
                                    <div class="form-group ">
                                        <?php 
                                            echo form_dropdown('programe_id', $program,$programe_id,  'class="form-control" id="feeProgrameId"');
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
                                    <label for="name">Batch</label>
                                    <div class="form-group ">
                                        <?php 
//                                        $Section = array('Section'=>"Section");
                                                
                                                echo form_dropdown('batch', $batch, $batchId,  'class="form-control" id="batch_id"');
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
                                    <label for="name">Payment Category</label>
                                    <div class="form-group ">
                                        <?php 
//                                        $Section = array('Section'=>"Section");
                                                echo form_dropdown('pc_id', $pc,$pc_id,  'class="form-control payment_cat" id="pc_id"');
                                        ?>
                                    </div>
                                </div> 
                                <div class="col-md-2">
                                    <label for="name">Challan Status</label>
                                    <div class="form-group ">
                                        <?php 
//                                        $Section = array('Section'=>"Section");
                                                echo form_dropdown('challan_status', $challan,$challan_id,  'class="form-control" ');
                                        ?>
                                    </div>
                                </div> 
                                
                                     </div>
                            <div class="row">
                                <div class="col-md-2 col-sm-5">
                                          <label for="name">Issue From Date</label>
                                        
                                           <div class="input-group" id="adv-search">
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
                                <div class="col-md-2 col-sm-5">
                                          <label for="name">Issue To Date</label>
                                        
                                           <div class="input-group" id="adv-search">
                                                <?php
                                                     echo  form_input(
                                                             array(
                                                                'name'          => 'to',
                                                                'type'          => 'text',
//                                                                'id'            => 'one_year',
                                                                'value'         => $to,
                                                                'class'         => 'form-control datepicker',
                                                                
                                                                 )
                                                             );
                                                      ?>
                                              </div>
                                            
                                     </div>
                            </div>
                              
                           </div><!--//section-content-->
                                     
                                 
                          <div style="padding-top:1%;">
                                <div class="col-md-5 pull-right">
                                    
                                    <button type="submit" class="btn btn-theme" name="filter" id="filter"  value="filter" ><i class="fa fa-search"></i> Search</button>
                                    <button type="button" class="btn btn-theme"   id="printChallan"  value="printChallan" ><i class="fa fa-print"></i> Print</button>
                                    <button type="button" class="btn btn-theme"    id="print_batch"  value="print_batch" ><i class="fa fa-print"></i> Print Last Challan</button>
                                    
     
                                </div>
                            </div>
                                    <?php
                                    echo form_close();
                                    ?>
                                
                             
                            
                        
                        
                        
                    </section>
           
                             <?php
                             
                          
                   if(!empty($result)):                      
        
        echo '<div class="row">
              <div class="col-md-12">';
                                        
                        
                                echo '<div id="div_print">
                                        <h3 class="has-divider text-highlight">Result :'; echo count(@$count); echo '</h3>
                                        
                                              <table class="table table-hover" id="table" style="font-size:11px;">
                                                    <thead>
                                                      <tr style="border: 1px solid #000000;">

                                                          <th style="border: 1px solid #000000;">#</th>
                                                          <th style="border: 1px solid #000000;">Form no#</th>
                                                           
                                                          <th style="border: 1px solid #000000;">College#</th>
                                                          <th style="border: 1px solid #000000;">Student Name</th>
                                                          <th style="border: 1px solid #000000;">Hostel</th>
                                                          <th style="border: 1px solid #000000;">Challan#</th>
                                                          <th style="border: 1px solid #000000;">Installment</th>
                                                          <th style="border: 1px solid #000000;">Actual</th>
                                                          <th style="border: 1px solid #000000;">Adj-Credit</th>
                                                          <th style="border: 1px solid #000000;">Arrears</th>
                                                          <th style="border: 1px solid #000000;">Cons.</th>
                                                          <th style="border: 1px solid #000000;">Paid</th>
                                                          <th style="border: 1px solid #000000;">Balance</th>
                                                          <th style="border: 1px solid #000000;">Credit</th>
                                                          <th style="border: 1px solid #000000;">Status</th>
                                                          <th style="border: 1px solid #000000;">Paid Date</th>
                                                          <th style="border: 1px solid #000000;">Update Challan</th>

                                                      </tr>
                                                    </thead>
                                                    <tbody>';
  
                                                        $sn = "";
                                                          foreach($result as $row):
//                                                            echo '<pre>';print_r($row);die;
                                                           $sn++;
                                                                           $this->db->join("hostel_status","hostel_status.hostel_status_id=hostel_student_record.hostel_status_id"); 
                                                                $hostel =  $this->db->get_where('hostel_student_record',array('student_id'=>$row->student_id))->row();
                                                                $hoste_status = '';
                                                                if($hostel):
                                                                    $hoste_status = $hostel->status_name;
                                                                     

                                                                endif;
                                                                   $where_inst_balance = array(
                                                                    'student_id'=>$row->student_id,  
                                                                    'pay_cat_id'=>$row->fc_pay_cat_id,  
                                                            );
                                                                  $balance_inst = $this->CRUDModel->get_where_row('fee_balance',$where_inst_balance);
                                                                $check = '';
                                                                  if(empty($balance_inst)):
                                                                    $check = 'not-exist';
                                                                    else:
                                                                    $check = 'exist';
                                                                endif;
                                                           
                                                                  $section_info = $this->db->get_where('sections',array('sec_id'=>$row->section_id_paid))->row();
//                                                                       echo '<pre>';print_r($row);die;
                                                                  $section_name = '';
                                                                  if($section_info):
                                                                      $section_name = $section_info->name;
                                                                      else:
                                                                      $section_name = 'Group Not Alloted';
                                                                  endif;
                                                                  
                                                                  
                                                                  $batch_info = $this->db->get_where('prospectus_batch',array('batch_id'=>$row->batch_id_paid))->row();
//                                                                       echo '<pre>';print_r($row);die;
                                                                  $batch_name = '';
                                                                  if($batch_info):
                                                                      $batch_name = $batch_info->batch_name;
                                                                      else:
                                                                      $batch_name = $row->batch_name;
                                                                  endif;
                                                                  
                                                          echo '<tr>
                                                                <td style="border: 1px solid #000000;">'.$sn.'</td>
                                                                <td style="border: 1px solid #000000;">'.$row->form_no.'</td>
                                                                 
                                                                <td style="border: 1px solid #000000;">'.$row->college_no.'</td>';
                                                                if($row->s_status_id == 5):
                                                                    echo '<td style="border: 1px solid #000000;"><a href="fullDetails/'.$row->student_id.'" target="_new"><strong title="'.$section_name.'/'.$row->father_name.', Class :('.$row->sessionName.'), Student status = '.$row->student_status.'") target="_new">'.substr($row->student_name, 0, 30).'</strong></a><br/>'.$batch_name.'<br/>'.$section_name.'<br/>'.$row->student_status.'</td>';
                                                                    else:
                                                                    echo '<td style="border: 1px solid #000000;"><a href="fullDetails/'.$row->student_id.'" target="_new"><strong title="'.$row->student_name.'/'.$row->father_name.', Class :('.$row->sessionName.'), Student status = '.$row->student_status.'") target="_new"><span style="color:red;">'.substr($row->student_name, 0, 30).'</span></strong></a><br/>'.$batch_name.'<br/>'.$section_name.'<br/>'.$row->student_status.'</td>';
                                                                endif;
                                                                
                                                                echo '<td style="border: 1px solid #000000;"><span style="color:red;">'.$hoste_status.'</strong></td>
                                                                    <td style="border: 1px solid #000000;">'.$row->fc_challan_id.'</td>';
                                                                 echo '<td style="border: 1px solid #000000;">'.$row->fee_installment.'</td>'; 

                                                                $totalpaid = '';
                                                                  if($row->ch_status_id == 2 || $row->ch_status_id == 3):
                                                                      $totalpaid = $row->total_Paid;
                                                                      else:
                                                                      $totalpaid = '';
                                                                  endif;
                                                                  
                                                                  
                                                                  
                                                                  $gBalance = $row->total_upPaid-$totalpaid-$row->concession ;
                                                                  if($row->old_credit > 0):
                                                                      $gBalance = $gBalance-$row->old_credit;
                                                                  endif;
                                                                       
                                                                        echo '<td style="border: 1px solid #000000; font-weight: bold;color: red;">'.$row->current.'</td>';
                                                                        echo '<td style="border: 1px solid #000000;">'.$row->old_credit.'</td>';
                                                                        echo '<td style="border: 1px solid #000000;">'.$row->arrears.'</td>';
                                                                        echo '<td style="border: 1px solid #000000;">'.$row->concession.'</td>';
                                                                      
                                                                        echo '<td style="border: 1px solid #000000;">'.$totalpaid.'</td>';
                                                                        echo ' <td style="border: 1px solid #000000;">'.$gBalance.'</td>';
                                                                          echo '<td style="border: 1px solid #000000;">'.$row->credit_amount.'</td>';
                                                                                                $this->db->order_by('fc_challan_id','desc');
                                                                                                $this->db->limit(0,1);
                                                                          $check_last_challan = $this->db->get_where('fee_challan',array('fc_student_id'=>$row->student_id))->row()->fc_challan_id;
                                                                         echo '<td style="border: 1px solid #000000;"><button  class="btn btn-warning btn-xs">'. $row->fcs_title.'</button></td>';
                                                                          
                                                                     
                                                                    
                                                                     '<td style="border: 1px solid #000000;"><a href="fullDetails/'.$row->student_id.'" target="_new">Full Details</a></td>';
                                                               $paid_date = '';
                                                               if($row->fc_paiddate == '0000-00-00'):
                                                               $paid_date = '';    
                                                                   else:
                                                                 $paid_date = date('d-m-Y',strtotime($row->fc_paiddate));   
                                                               endif;
                                                               
                                                               echo '  <td style="border: 1px solid #000000;">'.$paid_date.'</td>'; 
                                                               echo '  <td style="border: 1px solid #000000;"><button class="btn btn-theme btn-xs VerifyAmuntPopUp" id="'.$row->fc_challan_id.'"  data-toggle="modal" data-target="#VerifyAmuntPopUp" >Verify Challan</button></td>'; 
                                                                 
                                                              echo '  </tr>';
                                                         
                                                          endforeach;      
                                               

                                                      

                                                    echo'</tbody>
                                            </table>
                                        ';
                                          
                                 
                                    
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
  <div class="modal fade" id="VerifyAmuntPopUp" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Verify Student Amount</h4>
      </div>
      <div class="modal-body">
          <div id="verifyAmountShow">
              
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-theme" data-dismiss="modal">Close</button>
      
      </div>
    </div>
  </div>
</div>
  <script type="text/javascript">
      
       jQuery(document).ready(function(){
           
         jQuery('.VerifyAmuntPopUp').on('click',function(){
             var fc_challan_id = jQuery(this).attr('id');
              jQuery.ajax({
                type:'post',
                url:  'AdmVerifyPopUp', 
                data:  {'fc_challan_id':fc_challan_id},
                success: function(result){
                    jQuery('#verifyAmountShow').html(result);
                }
         }); 
         }); 
     
     jQuery('#batch_id').on('change',function(){
         var showFeeSubPro = jQuery('#showFeeSubPro').val();
         var batch_id = jQuery('#batch_id').val();
         jQuery.ajax({
             type:'post',
             url:  'FeeController/getPaymentCategoryBatchWise', 
             data:  {'sub_program_id':showFeeSubPro,'batch_id':batch_id},
             success: function(result){
                 jQuery('#pc_id').html(result);
             }
         });
         
     });
     
 });
      
      
      
      
        $(function() {
            $('.datepicker').datepicker( {
               changeMonth: true,
                changeYear: true,
                 dateFormat: 'dd-mm-yy'
           
            });
        });
    </script>
 
  <style>
      .datepicker{
          z-index: 1;
      }
  </style>     
  
 
  
  
   