 
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
                                          <label for="name">From</label>
                                        
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
                                          <label for="name">To</label>
                                        
                                           <div class="input-group" id="adv-search">
                                                <?php
                                                     echo  form_input(
                                                             array(
                                                                'name'          => 'to',
                                                                'type'          => 'text',
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
                                <div class="col-md-3 pull-right">
                                    
                                    <button type="submit" class="btn btn-theme" name="filter" id="filter"  value="filter" ><i class="fa fa-search"></i> Search</button>
                                    <button type="button" class="btn btn-theme"   id="printChallan"  value="printChallan" ><i class="fa fa-print"></i> Print</button>
                                    <button type="reset" class="btn btn-theme"  id="save"> Reset</button> 
     
                                </div>
                            </div>
                                    <?php
                                    echo form_close();
                                    ?>
                                
                             
                            
                        
                        
                        
                    </section>
           
                             <?php
                             
                             
                   if(!empty($result)):                      
        
        echo '<div class="row">
              <div class="col-md-12 ">';
                                        
                        
                                echo '<div id="div_print">
                                        <h3 class="has-divider text-highlight">Result :'; echo count($result); echo '</h3>
                                        <div class="table-responsive">
                                              <table class="table table-hover" id="table">
                                                    <thead>
                                                      <tr>

                                                          <th>#</th>
                                                          <th>Form no#</th>
                                                          <th>College#</th>
                                                          <th>Challan#</th>
                                                          <th>Student Name</th>
                                                          
                                                          <th>Installment</th>
                                                          
                                                          <th>Paid</th>
                                                          <th>Actual</th>
                                                          <th>Status</th>
                                                          <th>New Challan</th>
                                                          <th>Print</th>
                                                          <th>New Head</th>
                                                          <th>Full Details</th>
                                                          <th>Date</th>
                                                          

                                                      </tr>
                                                    </thead>
                                                    <tbody>';

                                                        $sn = "";
                                                          foreach($result as $row):
                                                              
                                                           $sn++;
                                                           
                                                           //total balance 
                                                            $balanceTotal = $this->db->where('challan_id',$row->fc_challan_id)->get('fee_actual_challan_detail')->result();
                                                        
                                                            $total_upPaid   = '';
                                                            $total_Paid     = '';
                                                            $total_balance     = '';
                                                                if($balanceTotal):
                                                                  
                                                                    foreach($balanceTotal as $rowTB):
                                                                    
//                                                                    if($rowTB->challan_status == 1):
//                                                                          $total_upPaid  += $rowTB->paid_amount;
//                                                                    endif;
                                                                        $total_upPaid  += $rowTB->actual_amount;
                                                                    
                                                                          $total_Paid  += $rowTB->paid_amount;
                                                                          $total_balance  += $rowTB->balance;
                                                                    
//                                                                    if($rowTB->challan_status == 2):
//                                                                          $total_Paid  += $rowTB->paid_amount;
//                                                                    endif;
                                                                  
                                                                    endforeach;
                                                                endif;
                                                                
                                                                
                                                                
                                                           //Total balance
//                                                                $remainBalance =  $this->db->where('student_id',$row->student_id)->get('fee_balance')->result();
                                                           
//                                                               $paid_date =  $this->CRUDModel->get_where_row('fee_challan_history',array('date'=>$row->fc_challan_id,'ch_status_id'=>2));
                                                               
                                                    $where =array(
                                          'sub_programes.sub_pro_id'=>$row->sub_pro_id,
                                          'batch_id'=>$row->batch_id,
                                           'fee_payment_category.pc_id'=>$row->fc_pay_cat_id,
                                      );
                                                 $this->db->join('sub_programes','sub_programes.sub_pro_id=fee_payment_category.sub_pro_id');
                                                 $this->db->join('fee_category_titles','fee_category_titles.cat_title_id=fee_payment_category.cat_title_id');
                                        $pc_id = $this->db->where($where)->get('fee_payment_category')->row();
                                       
                            
                                                                
                                                                
                                                                
                                                               
                                                            echo '<tr>
                                                                <td>'.$sn.'</td>
                                                                <td>'.$row->form_no.'</td>
                                                                <td>'.$row->college_no.'</td>
                                                                <td>'.$row->fc_challan_id.'</td>
                                                                <td>'.$row->student_name.'</td>
                                                                 
                                                                <td>'.$pc_id->title.'</td>
                                                              
                                                                
                                                                <td>'.$total_Paid.'</td>
                                                                <td>'.$total_balance.'</td>
                                                                <td ><button class="btn btn-warning btn-xs">'. $row->fcs_title.'</button></td>';
                                                           
                                                             $where_inst_balance = array(
                                                                    'student_id'=>$row->student_id,  
                                                                    'pay_cat_id'=>$row->fc_pay_cat_id,  
                                                            );
                                                            $balance_inst = $this->CRUDModel->get_where_row('fee_balance',$where_inst_balance);
                                                            
                                                            if(@$balance_inst->r_amount > '0'):
                                                            
                                                             
                                                            
                                                            if($row->ch_status_id == 2):
                                                                
                                                                
                                                            
                                                                 if($total_balance > 0):
                                                                $whereXY = array(
                                                                    'student_id'=>$row->student_id,
                                                                    'pay_cat_id'=>$row->fc_pay_cat_id
                                                                );
                                                    
                                                                      $instl_payment =$this->CRUDModel->get_where_row('fee_balance',$whereXY);
//                                                             
                                                                
                                                                     echo     '<td><a href="balanceChallan/'.$row->student_id.'/'.$row->fc_challan_id.'" class="btn btn-danger btn-xs "><span class="fa fa-download"> Balance Challan</span></a></td>';
                                                                    
                                                                     
                                                                     
                                                                         else:
                                                                         echo '<td></td>';
                                                                     endif;
                                                                 else:
                                                                   echo '<td></td>';  
                                                          
                                                                
                                                            endif;   
                                                               else:
                                                                 echo '<td></td>';
                                                            endif;
                                                            
//                                                           
                                                            echo '<td><a href="feeChallanPrint/'.$row->fc_challan_id.'/'.$row->student_id.'" class="btn btn-success btn-xs"><span class="fa fa-print"> Print</span></a></td>';
                                                                   
                                                                  
                                                                  if($row->ch_status_id == 1):
                                                                        
                                                                        echo '<td><a href="feeNewHead/'.$row->fc_challan_id.'/'.$row->student_id.'" class="btn btn-danger btn-xs "><span class="fa fa-download"> Add Head</span></a></td>';
                                                                        else:
                                                                       echo '<td><a href="feeNewHead/'.$row->fc_challan_id.'/'.$row->student_id.'" class="btn btn-danger btn-xs disabled"><span class="fa fa-download"> Add Head</span></a></td>';
                                                                    endif; 
                                                               echo     '<td><a href="fullDetails/'.$row->student_id.'" class="btn btn-success btn-xs ">Full Details</a></td>';
                                                                echo '  <td>'.date('d-m-Y',strtotime($row->fc_issue_date)).'</td>'; 
                                                                 
                                                              echo '  </tr>';
                                                         
                                                          endforeach;      
                                               

                                                      

                                                    echo'</tbody>
                                            </table>
                                        </div>';
                                          
                                 
                                    
                                    echo '</div>
                                    </div>
                                  
                                </div>';
                                  endif;
                             
                             ?>
                                  
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
          z-index: 1;
      }
  </style>     
  
 