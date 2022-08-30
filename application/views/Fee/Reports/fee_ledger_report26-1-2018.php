 
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
                            
                                        <div class="table-responsive">
                                              <table class="table table-hover" id="table" style="font-size:11px;">
                                                    <thead>
                                                      <tr>
                                                            <th>Student Details</th>
                                                            <th>From Date</th>
                                                            <th>To Date </th>
                                                            <th>Challan no</th>
                                                            <th>Payable</th>
                                                            <th>Concession</th>
                                                            <th>Net Payable</th>
                                                            <th>Arrears</th>
                                                            <th>Total Dues</th>
                                                            <th>Paid</th>
                                                            <th>Balance</th>
                                                            <th>Pay Date</th>
                                                            <th>Comments</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>';
  
                                                      
                                                          foreach($result as $std_info):
                                                             
                                                           
                                                           echo '<tr class="danger">
                                                                 
                                                                <td>'.$std_info->college_no.' - '.$std_info->student_name.'</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                '; 
                                                            echo '</tr>';
                                                            
                                                            $gPayable       = '';
                                                            $gConcession    = '';
                                                            $gNetPayable    = '';
                                                            $gPaid          = '';
                                                            $gBalances       = '';
                                                            $totalpaid      = '';
                                                          foreach($std_info->fee_details as $row):
                                                          
                                                          echo '<tr>
                                                                <td>&nbsp;&nbsp;&nbsp;'.$std_info->sessionName.' - '.$std_info->student_status.'</td>
                                                                <td>'.date('d-M-y',  strtotime($row->fc_paid_form)).'</td>
                                                                <td>'.date('d-M-y',  strtotime($row->fc_paid_upto)).'</td>
                                                                <td>'.$row->fc_challan_id.'</td>
                                                                ';
                                                                
                                                               
                                                                  if($row->ch_status_id == 2 || $row->ch_status_id == 3):
                                                                      $totalpaid = $row->total_Paid;
                                                                       
                                                                      else:
                                                                        $totalpaid = '';
                                                                  endif;
                                                                  
                                                                  
                                                                  
                                                                    $gBalance       = $row->total_upPaid-$totalpaid-$row->concession;
                                                                    $total_payable  = $row->total_upPaid-$row->concession;
                                                                        
                                                                        echo '<td>'.$row->total_upPaid.'</td>';
                                                                        echo '<td>'.$row->concession.'</td>';
                                                                        echo '<td>'.$total_payable.'</td>';
                                                                        echo '<td>'.$row->arrears.'</td>';
                                                                        echo '<td>'.$row->total_Paid.'</td>';
                                                                        echo '<td>'.$totalpaid.'</td>';
                                                                        echo '<td>'.$gBalance.'</td>';
                                                                         
                                                                        
                                                                            $paid_date = '';
                                                                            if($row->fc_paiddate == '0000-00-00'):
                                                                            $paid_date = '';    
                                                                                else:
                                                                              $paid_date = date('d-M-y',strtotime($row->fc_paiddate));   
                                                                            endif;

                                                                            echo '  <td>'.$paid_date.'</td>'; 
                                                                         
                                                                        echo '<td>'.$row->fc_comments.'</td>';
                                                                        echo '</tr>';
                                                                        
                                                                        
                                                                        $gPayable       += $row->total_upPaid;
                                                                        $gConcession    += $row->concession;
                                                                        $gNetPayable    += $total_payable;
                                                                        $gPaid          += $totalpaid;
                                                                        $gBalances       += $gBalance;
                                                                         
                                                                        
                                                                        
                                                         
                                                          endforeach;      
                                               
                                                             echo '<tr >
                                                                 
                                                                <td> </td>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td>'.$gPayable.'</td>
                                                                <td>'.$gConcession.'</td>
                                                                <td>'.$gNetPayable.'</td>
                                                                <td></td>
                                                                <td></td>
                                                                <td>'.$gPaid.'</td>
                                                                <td>'.$gBalances.'</td>
                                                                 
                                                                <td></td>
                                                                <td></td>
                                                                '; 
                                                            echo '</tr>';
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
  
 
  
  
  