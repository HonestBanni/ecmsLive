 
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
                                        <h3 class="has-divider text-highlight">Result :'; echo count(@$count); echo '</h3>
                                        <div class="table-responsive">
                                              <table class="table table-hover" id="table" style="font-size:11px;">
                                                    <thead>
                                                      <tr>

                                                          <th>#</th>
                                                          <th>Form no#</th>
                                                           
                                                          <th>College#</th>
                                                          <th>Challan#</th>
                                                          
                                                          <th>Student Name</th>
                                                          <th>Hostel</th>
                                                          <th>Installment</th>
                                                          <th>Actual</th>
                                                          <th>Arrears</th>
                                                          <th>Concession</th>
                                                          <th>Paid</th>
                                                          <th>Balance</th>
                                                          <th>Credit</th>
                                                          <th>Status</th>
                                                          <th>New Challan</th>
                                                          <th>Print</th>
                                                          <th>New Head</th>
                                                          <th>Canel</th>
                                                          <th>Paid Date</th>
                                                          

                                                      </tr>
                                                    </thead>
                                                    <tbody>';
  
                                                        $sn = "";
                                                          foreach($result as $row):
                                                           
                                                           $sn++;
                                                            
                                                                $hostel =  $this->CRUDModel->get_where_row('hostel_student_record',array('student_id'=>$row->student_id,'hostel_status_id'=>1));
                                                                $hoste_status = '';
                                                                if($hostel):
                                                                    $hoste_status = 'Hostel';

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
                                                          echo '<tr>
                                                                <td>'.$sn.'</td>
                                                                <td>'.$row->form_no.'</td>
                                                                 
                                                                <td>'.$row->college_no.'</td>
                                                                <td>'.$row->fc_challan_id.'</td>';
                                                          if($row->s_status_id == 5):
                                                               echo '<td><a href="fullDetails/'.$row->student_id.'" target="_new"><strong title="'.$row->student_name.'/'.$row->father_name.', Class :('.$row->sessionName.'), Student status = '.$row->student_status.'") target="_new">'.substr($row->student_name, 0, 15).'</strong></a></td>';
                                                                else:
                                                               echo '<td><a href="fullDetails/'.$row->student_id.'" target="_new"><strong style="color:red;"  title="'.$row->student_name.'/'.$row->father_name.', Class :('.$row->sessionName.'), Student status = '.$row->student_status.'") target="_new">'.substr($row->student_name, 0, 15).'</strong></a></td>';
                                                          endif;
                                                                echo '<td>'.$hoste_status.'</td>
                                                                <td>'.$row->fee_installment.'</td>';
                                                                
                                                                $totalpaid = '';
                                                                  if($row->ch_status_id == 2 || $row->ch_status_id == 3):
                                                                      $totalpaid = $row->total_Paid;
                                                                      else:
                                                                      $totalpaid = '';
                                                                  endif;
                                                                  
                                                                  
                                                                  
                                                                  $gBalance = $row->total_upPaid-$totalpaid-$row->concession;
                                                                  
                                                                        echo '<td>'.$row->current.'</td>';
                                                                        echo '<td>'.$row->arrears.'</td>';
                                                                        echo '<td>'.$row->concession.'</td>';
                                                                      
                                                                        echo '<td>'.$totalpaid.'</td>';
                                                                        echo ' <td>'.$gBalance.'</td>';
                                                                          echo '<td>'.$row->credit_amount.'</td>';
                                                                echo '<td ><button class="btn btn-warning btn-xs">'. $row->fcs_title.'</button></td>';
                                                           
                                                          
                                                          
//                                                            echo '<pre>';print_r($balance_inst);die;
                                                            if(@$balance_inst->r_amount > '0'):
                                                            
                                                             
                                                            
                                                            if($row->ch_status_id == 2):
                                                                
                                                                
                                                            
//                                                                 if($gBalance > 0):
                                                                $whereXY = array(
                                                                    'student_id'=>$row->student_id,
                                                                    'pay_cat_id'=>$row->fc_pay_cat_id
                                                                );
                                                    
                                                                        $instl_payment =$this->CRUDModel->get_where_row('fee_balance',$whereXY);
//                                                             
                                                                      echo     '<td><a href="balanceChallan/'.$row->student_id.'/'.$row->fc_challan_id.'" class="btn btn-danger btn-xs "><span class="fa fa-download"> Balance Challan</span></a></td>';
//                                                                        if($row->challan_id_lock == 0):
//                                                                             echo     '<td><a href="balanceChallan/'.$row->student_id.'/'.$row->fc_challan_id.'" class="btn btn-danger btn-xs "><span class="fa fa-download"> Balance Challan</span></a></td>';
//                                                                        else:
//                                                                            echo '<td></td>';
//                                                                        endif;
//                                                                            challan_id_lock
                                                                            
                                                                     
                                                                     
                                                                        
//                                                                     endif;
                                                                 else:
                                                                   echo '<td></td>';  
                                                          
                                                                
                                                            endif;   
                                                               else:
                                                                 echo '<td></td>';
                                                            endif;
                                                            
//                                                           
                                                                 
                                                                  if($row->ch_status_id == 1):
                                                                         echo '<td><a href="feeChallanPrint/'.$row->fc_challan_id.'/'.$row->student_id.'" class="btn btn-success btn-xs"><span class="fa fa-print"> Print</span></a></td>';
                                                                   
                                                            
                                                                        echo '<td><a href="feeNewHead/'.$row->fc_challan_id.'/'.$row->student_id.'" class="btn btn-danger btn-xs "><span class="fa fa-download"> Update Heads</span></a></td>';
                                                                        echo '<td><a href="cancelChallanURI/'.$row->fc_challan_id.'" class="btn btn-warning btn-xs "><span class="fa fa-crosshairs"> Cancel</span></a></td>';
                                                                        else:
                                                                             echo '<td><a class="btn btn-success btn-xs"><span class="fa fa-print"> Print</span></a></td>';
                                                                   
                                                            
                                                                       echo '<td><a  class="btn btn-danger btn-xs disabled"><span class="fa fa-download"> Update Heads</span></a></td>';
                                                                       echo '<td><a  class="btn btn-warning btn-xs disabled"><span class="fa fa-crosshairs"> Cancel</span></a></td>';
                                                                    endif; 
                                                                    
                                                                     '<td><a href="fullDetails/'.$row->student_id.'" target="_new">Full Details</a></td>';
                                                               $paid_date = '';
                                                               if($row->fc_paiddate == '0000-00-00'):
                                                               $paid_date = '';    
                                                                   else:
                                                                 $paid_date = date('d-m-Y',strtotime($row->fc_paiddate));   
                                                               endif;
                                                               
                                                               echo '  <td>'.$paid_date.'</td>'; 
                                                                 
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
  
 