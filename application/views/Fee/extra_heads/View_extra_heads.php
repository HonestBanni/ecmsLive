 
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
                                                                 )
                                                             );
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'student_id',
                                                                'type'          => 'hidden',
                                                                'value'         => $studentInfo->student_id,
                                                                'class'         => 'form-control',
                                                                'placeholder'   => 'Student Name',
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
                                                                'value'         => $studentInfo->subProgram.'('.$studentInfo->sectionName.')',
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
                            
                            
                           
                           
                            
                           <br/>
                                    <?php
                                    echo form_close();
                                    ?>
                                
                             
                            
                        </div>  
                        
                        
                    </section>
           
                             <?php
                             
                             
                   if(!empty($result)):                      
        
        echo '<div class="row">
              <div class="col-md-12">';
                                        
                        
                                 echo '<div id="div_print">
              
                                        
                                        <div class="table-responsive">
                                              <table class="table table-hover" id="table">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Fee Head</th>
                                                            <th>Amount</th>
                                                            <th>Date</th>
                                                            <th>Status</th>
                                                            <th>Commment</th>
                                                            <th>Update</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>';
                                 $sn= '';
                                    foreach($result as $resultRow):
                                        $sn++;
                              
                                            echo '<tr>
                                                <td>'.$sn.'</td>
                                                <td>'.$resultRow->fh_head.'</td>
                                                <td>'.$resultRow->amount.'</td>
                                                <td>'.date('d-m-Y',strtotime($resultRow->fine_date)).'</td>
                                                <td>'.$resultRow->fine_title.'</td>
                                                <td>'.$resultRow->fine_comments.'</td>';
                                                if($resultRow->apply_status == 2):
                                                    echo '<td></td>';
                                                else:
                                                    echo '<td><a href="updateExtraHeads/'.$studentInfo->student_id.'/'.$resultRow->fee_id.'" class="btn btn-danger btn-xs ">Update</a></td>';
                                                endif;
                                            
                                                       
                                                        echo '</tr>';
                                            endforeach;      
                                                echo '</tbody>
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