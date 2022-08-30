 
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
              <section class="course-finder" >
                        <h1 class="section-heading text-highlight">
                            <span class="line"><?php echo $page_header?> Panel</span>
                        </h1>
                        <div class="section-content" >
                           <?php echo form_open('',array('class'=>'course-finder-form'));
                                  
                                     ?>
                                <div class="row">
                                    
                                    
                                <div class="col-md-3 col-sm-5">
                                        <label for="name">College #</label>
                                         
                                                <?php
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'collegeNo',
                                                                'type'          => 'number',
                                                                'value'         => $studentInfo->college_no,
                                                                'class'         => 'form-control',
                                                                 'readonly'      => 'readonly',
                                                                'placeholder'   => 'College #')
                                                             );
                                                      ?>
                                               
                                            
                                     </div>
                                <div class="col-md-3 col-sm-5">
                                          <label for="name">Name</label>
                                        
                                           
                                                <?php
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'stdName',
                                                                'type'          => 'text',
                                                                'value'         => $studentInfo->student_name,
                                                                'class'         => 'form-control',
                                                                'placeholder'   => 'Student Name',
                                                                'readonly'      => 'readonly',
                                                                 )
                                                             );
                                                      ?>
                                             
                                            
                                     </div>
                                <div class="col-md-3 col-sm-5">
                                          <label for="name">Class</label>
                                        
                                          
                                                    
                                                <?php
                                                    echo  form_input(
                                                             array(
//                                                                'name'          => 'fatherName',
                                                                'type'          => 'text',
                                                                'value'         => $studentInfo->sub_proram,
                                                                'class'         => 'form-control',
                                                                'placeholder'   => 'Father Name',
                                                                 )
                                                             );
                                                      ?>
                                           
                                            
                                     </div>
                                <div class="col-md-3 col-sm-5">
                                            <label for="name">Batch</label>
                                           
                                                    
                                                <?php
                                                    echo  form_input(
                                                             array(
//                                                                'name'          => 'fatherName',
                                                                'type'          => 'text',
                                                                'value'         => $studentInfo->batch_name,
                                                                'class'         => 'form-control',
                                                                'placeholder'   => 'Father Name',
                                                                 )
                                                             );
                                                      ?>
                                              
                                            
                                     </div>
                           
                           
                              
                           </div><!--//section-content-->
                            
                           <div class="row">
                                      
                                     
                                     <?php 
                                     if($studentInfo->head_type == 1):
                                       ?>
                               
                               
                               <div class="col-md-3 col-sm-5">
                                              <label for="name">Fee Head</label>
                                              
                                                  <?php 
                                            
                                               echo  form_input(
                                                        array(
                                                           'name'          => 'fee_head_name',
                                                           'id'            => 'fee_head_name_add',
                                                           'class'         => 'form-control',
                                                           'placeholder'   => 'Hostel Head',
                                                            )
                                                        );
                                            echo  form_input(
                                                        array(
                                                           'name'          => 'fee_head_id',
                                                           'id'            => 'fee_head_id_add',
                                                           'class'         => 'form-control',
                                                           'type'           => 'hidden',
                                                            )
                                                        );
                                            echo  form_input(
                                                        array(
                                                           'name'           => 'hostel_id',
                                                           'value'          => $this->uri->segment(2),
                                                           'class'          => 'form-control',
                                                           'type'           => 'hidden',
                                                            )
                                                        );
                                            echo  form_input(
                                                        array(
                                                           'name'          => 'challan_id',
                                                            'value'          => $this->uri->segment(3),
                                                           'class'         => 'form-control',
                                                           'type'           => 'hidden',
                                                            )
                                                        );
                                            echo  form_input(
                                                        array(
                                                           'name'          => 'batch_id',
                                                            'value'        => $studentInfo->batch_id,
                                                           'class'         => 'form-control',
                                                           'type'          => 'hidden',
                                                           
                                                            )
                                                        );
                                            echo  form_input(
                                                        array(
                                                           'name'          => 'hostel_challan_type',
                                                            'value'        => $studentInfo->head_type,
                                                           'class'         => 'form-control',
                                                           'type'          => 'hidden',
                                                           
                                                            )
                                                        );
                                            echo  form_input(
                                                        array(
                                                           'name'          => 'challan_status',
                                                            'value'        => $studentInfo->challan_status,
                                                           'class'         => 'form-control',
                                                           'type'          => 'hidden',
                                                           
                                                            )
                                                        );
//                                             
                                            ?>
                                              
                                          
                                    </div>
                               
                               
                                        <div class="col-md-3 col-sm-5">
                                          <label for="name">Account</label>
                                                <?php
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'amount',
                                                                'id'            => 'fee_head_amount',
                                                                'type'          => 'number',
//                                                                'value'       => $recordFrom,
                                                                'class'         => 'form-control',
                                                                'placeholder'   => 'Amount',
                                                                 )
                                                             );
                                                      ?>
                                            
                                            
                                        </div>
                                    <div class="col-md-3 col-sm-5">
                                          <label for="name">Balance Type</label>
                                        
                                           
                                                <?php
                                                    echo form_dropdown('balance_type', $balance_type, 0,  'class="form-control"');
                                                      ?>
                                            
                                            
                                     </div>
                               
                               
                               <div class="col-md-6">
                                    <label for="name">Comments</label>
                                        <?php 
                                            echo form_textarea(array(
                                                'name'          => 'comments',
                                                'cols'          => '40',
                                                 'rows'          => '2',
                                                'class'         => 'form-control',
                                                  
                                                ));
                                           
                                         ?>
                                    </div>
<!--                                        <div class="col-md-2">
                                           <label for="name">Pre Challan</label>
                                           <div class="form-group ">
                                               <?php 
                                                
                                                       echo form_dropdown('pre_challan', $pre_challan,'',  'class="form-control"');
                                               ?>
                                           </div>
                                       </div> -->
                                         
                                           <?php
                                           
                                           else:
                                            ?>

                                            <div class="col-md-3 col-sm-5">
                                              <label for="name">Fee Head</label>
                                              
                                                  <?php 
                                            
                                               echo  form_input(
                                                        array(
                                                           'name'          => 'fee_head_name',
                                                           'id'            => 'mess_add_heads',
                                                           'class'         => 'form-control',
                                                           'placeholder'   => 'Mess Heads',
                                                            )
                                                        );
                                            echo  form_input(
                                                        array(
                                                           'name'          => 'fee_head_id',
                                                           'id'            => 'mess_add_heads_id',
                                                           'class'         => 'form-control',
                                                           'type'           => 'hidden',
                                                            )
                                                        );
                                            echo  form_input(
                                                        array(
                                                           'name'           => 'hostel_id',
                                                           'value'          => $this->uri->segment(2),
                                                           'class'          => 'form-control',
                                                           'type'           => 'hidden',
                                                            )
                                                        );
                                            echo  form_input(
                                                        array(
                                                           'name'          => 'challan_id',
                                                            'value'          => $this->uri->segment(3),
                                                           'class'         => 'form-control',
                                                           'type'           => 'hidden',
                                                            )
                                                        );
                                            echo  form_input(
                                                        array(
                                                           'name'          => 'batch_id',
                                                            'value'        => $studentInfo->batch_id,
                                                           'class'         => 'form-control',
                                                           'type'          => 'hidden',
                                                           
                                                            )
                                                        );
                                            echo  form_input(
                                                        array(
                                                           'name'          => 'hostel_challan_type',
                                                            'value'        => $studentInfo->head_type,
                                                           'class'         => 'form-control',
                                                           'type'          => 'hidden',
                                                           
                                                            )
                                                        );
                                            echo  form_input(
                                                        array(
                                                           'name'          => 'challan_status',
                                                            'value'        => $studentInfo->challan_status,
                                                           'class'         => 'form-control',
                                                           'type'          => 'hidden',
                                                           
                                                            )
                                                        );
//                                             
                                            ?>
                                              
                                          
                                    </div>
                                            
                                        <div class="col-md-3 col-sm-5">
                                          <label for="name">Total Days</label>
                                                <?php
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'total_days',
                                                                'id'            => 'total_days',
                                                                'type'          => 'number',
//                                                                'value'       => $recordFrom,
                                                                'class'         => 'form-control',
                                                                'placeholder'   => 'Amount',
                                                                 )
                                                             );
                                                      ?>
                                         </div>        
                                        <div class="col-md-3 col-sm-5">
                                          <label for="name">Per Days</label>
                                                <?php
                                                    echo form_input(array(
                                                    'name'          => 'per_day',
                                                    'id'            => 'per_day',
                                                    'class'         => 'form-control',
                                                    'value'         => $per_day->amount,
                                                    'type'          => 'text',
                                                    'readonly'      =>'readonly'    
                                                    ));
                                                echo form_input(array(
                                                    'name'          => 'per_day_id',
                                                    'id'            => 'per_day_id',
                                                    'class'         => 'form-control',
                                                    'value'         => $per_day->id,
                                                    'type'          => 'hidden',
                                                      
                                                    ));
                                                      ?>
                                         </div>        
                                        <div class="col-md-3 col-sm-5">
                                          <label for="name">Account</label>
                                                <?php
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'amount',
                                                                'id'            => 'total_amount',
                                                                'type'          => 'number',
//                                                               'value'         => $per_day->amount,
                                                                'class'         => 'form-control',
                                                                  
                                                                'placeholder'   => 'Amount',
                                                                 )
                                                             );
                                                      ?>
                                         </div>   
                                          <div class="col-md-3 col-sm-5">
                                          <label for="name">Balance Type</label>
                                        
                                           
                                                <?php
                                                    echo form_dropdown('balance_type', $balance_type, 0,  'class="form-control"');
                                                      ?>
                                            
                                            
                                     </div>
                                    <div class="col-md-6">
                                    <label for="name">Comments</label>
                                        <?php 
                                            echo form_textarea(array(
                                                'name'          => 'comments',
                                                'cols'          => '40',
                                                 'rows'          => '2',
                                                'class'         => 'form-control',
                                                  
                                                ));
                                           
                                         ?>
                                    </div>
                                                
                                                   
                                            <?php
                                     endif;
                                     
                                     ?>
                                      
                                 
                                     
                                </div> 
                           <div style="padding-top:1%;">
                                <div class="col-md-3 pull-right">
                                     <button type="submit" class="btn btn-theme" name="filter" id="filter"  value="filter" ><i class="fa fa-plus"></i> Add</button>
                                     <a href="hostelPrintChallan/<?php echo $this->uri->segment(2) ?>/<?php echo $this->uri->segment(3) ?>" class="btn btn-theme"><span class="fa fa-print"> Print</span></a>
                                     <!--<button type="submit" class="btn btn-theme" name="fee_print" id="fee_print"  value="fee_print" ><i class="fa fa-plus"></i> Print</button>-->
                                    <button type="reset" class="btn btn-theme"  id="save"> Reset</button> 
     
                                </div>
                            </div>
                           <br/>
                                    <?php
                                    echo form_close();
                                    ?>
                                
                             
                            
                        </div>  
                        
                        
                    </section>
           
                             <?php
                             
                             
                   if(!empty($result)):                      
        
        echo '<div class="row">
              <div class="col-md-8 col-md-offset-2">';
                                        
                           
                                 echo '<div id="div_print">
              
                                        
                                        <div class="table-responsive">
                                              <table class="table table-hover" id="table">
                                                    <thead>
                                                      <tr>

                                                          <th>#</th>
                                                          <th>Title</th>
                                                          <th></th>
                                                          <th>Balance</th>
                                                          <th>Comments</th>
                                                          <th>Update</th>
                                                          <th>Delete</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>';

                                                        $sn = "";
                                                         $total_amount = '';
                                                          foreach($result as $row):
                                                                 $sn++;
                                                              $status = '';
                                                              if(!empty($row->old_challan_id)):
                                                                  $status = 'Arrears';
                                                              else:
                                                                   $status = 'Current Bill';
                                                              endif;
                                                        echo '<tr ">
                                                                <td>'.$sn.'</td>
                                                                <td>'.$row->title.'</td>
                                                                <td>'.$status.'</td>
                                                                <td>'.$row->amount.'</td>
                                                                <td>'.$row->comments.'</td>
                                                                 <th><a href="updateHostelHead/'.$this->uri->segment(2).'/'.$this->uri->segment(3).'/'.$row->info_pk.'" class="btn btn-success btn-xs">Update</a></th>
                                                                 <th><a href="deleteHostelHead/'.$this->uri->segment(2).'/'.$this->uri->segment(3).'/'.$row->info_pk.'" class="btn btn-danger btn-xs">Delete</a></th>
                                                               </tr>';
                                                    
                                                        $total_amount +=$row->amount;
                                                          endforeach;      
                                               
                                                           
                                                         echo '<tr>
                                                                <td> </td>
                                                                <td> </td>
                                                                 
                                                                <td>Total</td>
                                                                
                                                                <th>'.$total_amount.'</th>
                                                               
                                                                <th> </th>
                                                                   
                                                               </tr>';

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
        numberOfMonths: 3,
        dateFormat: 'dd-mm-yy'
    });
  } );
    jQuery('#total_days').keyup(function(){
      var total_days    = jQuery('#total_days').val();
      var per_day       = jQuery('#per_day').val();
      jQuery('#total_amount').val(total_days*per_day);
  });
  
  
  
  </script>    
     
  
 