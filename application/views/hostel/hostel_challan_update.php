 
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
                                                 
//                                              
                                                
                                                
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
                                     <div class="col-md-3 col-sm-5">
                                         <label for="name">Date From</label>
                                         <?php
//                                            
                                                echo form_input(array(
                                                    'name'          => 'date_from',
                                                    'class'         => 'form-control datepicker',
                                                    'placeholder'   => 'From Date',
                                                    'type'          => 'text',
                                                    'value'         => date('d-m-Y',strtotime($studentInfo->date_from)),
                                                    ));
                                                 
                                             
                                            ?>
                                     
                                     </div>
                                     <div class="col-md-3 col-sm-5">
                                         <label for="name">Date To</label>
                                         <?php

                                                echo form_input(array(
                                                    'name'          => 'date_to',
                                                    'class'         => 'form-control datepicker',
                                                    'placeholder'   => 'From To',
                                                    'type'          => 'text',
                                                   'value'         => date('d-m-Y',strtotime($studentInfo->date_to)),
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
                                                    'value'         => date('d-m-Y',strtotime($studentInfo->issue_date)),
                                                    ));
                                                 
                                             
                                            ?>
                                     
                                     </div>
                                     <div class="col-md-3 col-sm-5">
                                         <label for="name">Valid Date</label>
                                         <?php

                                                echo form_input(array(
                                                    'name'          => 'valid_date',
                                                    'class'         => 'form-control datepicker',
                                                    'placeholder'   => 'Valid Date',
                                                    'type'          => 'text',
                                                    'value'         => date('d-m-Y',strtotime($studentInfo->valid_date)),
                                                    ));
                                                 
                                             
                                                
                                                
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
                                                            'value'          => $studentInfo->batch_id,
                                                           'class'         => 'form-control',
                                                           'type'           => 'hidden',
                                                           
                                                            )
                                                        );
                                                
                                                
                                            ?>
                                     
                                     </div>
                                
                            </div>
                           <div class="row">
                               <div class="col-md-6 col-sm-5">
                                         
                                           
                                    <label for="name">Comments</label>
                                        <?php 
                                            echo form_textarea(array(
                                                'name'          => 'comments',
                                                'value'         => $studentInfo->comments,
                                                'cols'          => '40',
                                                 'rows'          => '2',
                                                'class'         => 'form-control',
                                                  
                                                ));
                                           
                                         ?>
                                   
                                     
                                     </div>
                               
                           </div>
                               
                           
                           
                            
                           <div style="padding-top:1%;">
                                <div class="col-md-3 pull-right">
                                     <button type="submit" class="btn btn-theme" name="filter" id="filter"  value="filter" ><i class="fa fa-plus"></i> Update</button>
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
                                                          <th>Balance</th>
                                                           
                                                        </tr>
                                                    </thead>
                                                    <tbody>';

                                                        $sn = "";
                                                         $total_amount = '';
                                                          foreach($result as $row):
                                                               
                                                        echo '<tr ">
                                                                <td>'.$sn.'</td>
                                                                <td>'.$row->title.'</td>
                                                                <td>'.$row->amount.'</td>
                                                                 
                                                               </tr>';
                                                      
                                                        $total_amount +=$row->amount;
                                                          endforeach;      
                                               
                                                           
                                                         echo '<tr>
                                                                <td> </td>
                                                                 
                                                                <td>Total</td>
                                                                
                                                                <th>'.$total_amount.'</th>
                                                               
                                                                 
                                                                   
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
        numberOfMonths: 1,
        dateFormat: 'dd-mm-yy'
    });
  } );
 
  
  
  
  </script> 