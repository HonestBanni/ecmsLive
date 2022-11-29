 
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
                                      
                                     <div class="col-md-3 col-sm-5">
                                         <label for="name">Search Std Name,College# and Form#</label>
                                         <?php

                                                echo form_input(array(
                                                    'name'          => 'h_student_name',
                                                    'id'          => 'h_student_name',
                                                    'class'         => 'form-control',
                                                    'placeholder'   => 'student Name',
                                                    'type'          => 'text',
//                                                    'value'         => $feehead,
                                                    ));
                                                echo form_input(array(
                                                    'name'          => 'h_student_id',
                                                    'id'            => 'h_student_id',
                                                    'class'         => 'form-control',
                                                    'placeholder'   => 'student_id',
                                                    'type'          => 'hidden',
//                                                    'value'         => $id,
                                                    ));
                                             
                                            ?>
                                     
                                     </div>
                                     <div class="col-md-3 col-sm-5">
                                         <label for="name">Installment No</label>
                                         <?php
                                            echo form_dropdown('inst_type', $inst_type,'1',  'class="form-control" id="installmentNo" required="required"');
                                             ?>
                                     
                                     </div>
                                     <div class="col-md-3 col-sm-5">
                                         <label for="name">Date From</label>
                                         <?php
                                                $from_date = '';
                                                if(!empty($default_date)):
                                                    $from_date = $default_date->fromDate;
                                                    else:
                                                   $from_date = ''; 
                                                endif;
                                                
                                                echo form_input(array(
                                                    'name'          => 'date_from',
                                                    'class'         => 'form-control datepicker',
                                                    'placeholder'   => 'From Date',
                                                    'type'          => 'text',
                                                    'required'      => 'required',
//                                                    'value'         => '01-09-2020'
//                                                    'value'         => date('d-m-Y',  strtotime($from_date))
                                                    'value'         => date('d-m-Y')
                                                    ));
                                                 
                                             
                                            ?>
                                     
                                     </div>
                                     <div class="col-md-3 col-sm-5">
                                         <label for="name">Date To</label>
                                         <?php
                                                $to_date = '';
                                                if(!empty($default_date)):
                                                    $to_date = $default_date->toDate;
                                                    else:
                                                   $to_date = ''; 
                                                endif;
                                                echo form_input(array(
                                                    'name'          => 'date_to',
                                                    'class'         => 'form-control datepicker',
                                                    'placeholder'   => 'From To',
                                                    'type'          => 'text',
                                                    'required'      => 'required',
//                                                    'value'         => '30-09-2020'
//                                                    'value'         => date('d-m-Y',  strtotime($to_date))
                                                    'value'         => date('d-m-Y')
                                                    ));
                                                 
                                             
                                            ?>
                                     
                                     </div>
                                     <div class="col-md-3 col-sm-5">
                                         <label for="name">Valid Date</label>
                                         <?php
                                                $valid_date = '';
                                                if(!empty($default_date)):
                                                    $valid_date = $default_date->validDate;
                                                    else:
                                                   $valid_date = ''; 
                                                endif;
                                         
                                                    echo form_input(array(
                                                    'name'          => 'valid_date',
                                                    'class'         => 'form-control datepicker',
                                                    'placeholder'   => 'Valid Date',
                                                    'type'          => 'text',
                                                    'required'      => 'required',
                                                    'value'         => date('d-m-Y')
//                                                    'value'         => date('d-m-Y',  strtotime($valid_date))
                                                    ));
                                                 
                                             
                                            ?>
                                     
                                     </div>
                                     <div class="col-md-3 col-sm-5">
                                         <label for="name">Issue Date</label>
                                         <?php

                                                echo form_input(array(
                                                    'name'          => 'issue_date',
                                                    'class'         => 'form-control datepicker',
                                                    'placeholder'   => 'Issue Date',
                                                    'type'          => 'text',
                                                    'value'         => date('d-m-Y'),
                                                    ));
                                                 
                                             
                                            ?>
                                     
                                     </div>
                                     <div class="col-md-6 col-sm-5">
                                         <label for="name">Bank</label>
                                         <?php

                                               echo form_dropdown('bank', $bank,$default_bank,  'class="form-control"');
                                                 
                                             
                                            ?>
                                     
                                     </div>
                                    <div class="col-md-12">
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
                                    
                                     
                                      
                                     
                                
                                      
                                     
                                      
                                </div>
                          <div style="padding-top:1%;">
                                <div class="col-md-3 pull-right">
                                    
                                    <button type="submit" class="btn btn-theme" name="add" id="add"  value="add" ><i class="fa fa-plus"></i> Generate Bill</button>
                                    
                                    
                                        
                                    
                                </div>
                            </div>
                                    <?php
                                    echo form_close();
                                    ?>
                                
                             
                            
                         </div><!--//section-content-->
                        
                        
                    </section>
                        
                            <div class="row">
                                    <div class="col-md-12">
                                        <?php
                                        $class = array(
                                                'info',
                                                'success',
                                                'danger',
                                                'warning',
                                                'active',
                                            );
                                
                                      if(!empty($result)):
                                          
                                    
                                        ?>
                                     <div id="div_print">
              
                                        <h3 class="has-divider text-highlight">Result :<?php echo count($result)?></h3>
                                        <div class="table-responsive">
                                              <table class="table table-hover" id="table">
                                                    <thead>
                                                      <tr>

                                                          <th>#</th>
                                                          <th>Head </th>
                                                          <th>Amount</th>
                                                          <th>Status</th>
                                                          <th>Edit</th>
                                                          <th>Delete</th>

                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $sn = '';
                                                       
                                                          foreach($result as $row):
                                                              
                                                              $k = array_rand($class);
                                                           $sn++;
                                                            echo '<tr class="'.$class[$k].'">
                                                                <td>'.$sn.'</th>
                                                                <td>'.$row->title.'</td>
                                                                <td>'.$row->amount.'</td>
                                                                     <td>'; 
                                                            if($row->status == 1):
                                                                  echo '<button class="btn btn-success btn-xs">Active</button>';
                                                                  else:
                                                                  echo '<button class="btn btn-info btn-xs">Deactive</button>';
                                                              endif;
                                                            
                                                            echo '</td>
                                                                 ';
                                                                       ?>
                                                                    <td>  <a href="hostelMessHeads/<?php echo $row->id;?>"  class="productstatus"><button type="button" class="btn btn-theme btn-xs"> Edit </button></a>
                                                                  </td> 
                                                                  <td> 
                                                                   <a href="HMDelete/<?php echo $row->id;?>"  onclick="return confirm('Are You Sure to Delete This..?')"  class="productstatus"><button type="button" class="btn btn-danger btn-xs"> Delete</button></a>
                                                                   </td>  
                                                                <?php
                                                                    
                                                            echo '</tr>';
                                                         
                                                          endforeach;      
                                               

                                                        ?>

                                                    </tbody>
                                            </table>
                                        </div>
                                          <?php
                                      endif;
                                    ?> 
                                    </div>
                                    </div>
                                  
                                </div>
 
          </div>
          
      
      </div>
                 </div>
                
    
      
        <!--//page-row-->
      </div>
      <!--//page-content-->
    </div>
    <!--//page-wrapper--> 
 
     
   
     
     <script>
             jQuery(document).ready(function(){
                    jQuery('#installmentNo').on('change',function(){
                        
                       var instalId = jQuery(this).val();
                       var h_student_id = jQuery('#h_student_id').val();
                       jQuery.ajax({
                            type        : 'post',
                            url         : 'HosteInstallmetnJS',
                            async       : false,
                            dataType    : 'json',
                            data        : {'instalId':instalId,'h_student_id':h_student_id},
                            success: function(result){
                                console.log(result);
                            }

                       });
                    });
             });
         
         
         
  $( function() {
    $( ".datepicker" ).datepicker({
        changeMonth: true,
        changeYear: true,
         dateFormat: 'dd-mm-yy'
    });
  } );
  </script>        
   