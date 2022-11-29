<style>
    .form-control{
        /*height: 26px;*/
        font-size: 12px;
    }
</style> 
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
                                        <label for="name">College #</label>
                                        <div class="input-group" id="adv-search">
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
                                            
                                     </div>
                                <div class="col-md-2 col-sm-5">
                                          <label for="name">Name</label>
                                        
                                           <div class="input-group" id="adv-search">
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
                                                      ?>
                                              </div>
                                            
                                     </div>
                                <div class="col-md-2 col-sm-5">
                                          <label for="name">Class</label>
                                        
                                           <div class="input-group" id="adv-search">
                                                    
                                                <?php
                                                    echo  form_input(
                                                             array(
//                                                                'name'          => 'fatherName',
                                                                'type'          => 'text',
                                                                'value'         => $studentInfo->sub_proram.'('.$studentInfo->sectionsName.')',
                                                                'class'         => 'form-control',
                                                                'placeholder'   => 'Father Name',
                                                                 )
                                                             );
                                                      ?>
                                              </div>
                                            
                                     </div>
                                <div class="col-md-2 col-sm-5">
                                            <label for="name">Batch</label>
                                            <div class="input-group" id="adv-search">
                                                    
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
                                            
                                     </div>
                                <div class="col-md-2 col-sm-5">
                                            <label for="name">Comments</label>
                                            <div class="input-group" id="adv-search">
                                                <?php
                                                    echo form_textarea(
                                                             array(
                                                             'cols'=>30,
                                                             'rows'=>2,
                                                              'value'         => $feeComments->fc_comments,
                                                            
                                                                 )
                                                             );
                                                      ?>
                                              </div>
                                            
                                     </div>
                           
                              
                           </div><!--//section-content-->
                                     
                                 
                          <div style="padding-top:1%;">
                                <div class="col-md-3 pull-right">
                                    
                                    <button type="submit" class="btn btn-theme" name="filter" id="filter"  value="filter" ><i class="fa fa-search"></i> Search</button>
                                    <!--<button type="submit" class="btn btn-theme" name="fee_print" id="fee_print"  value="fee_print" ><i class="fa fa-plus"></i> Print</button>-->
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
              <div class="col-md-8 col-md-offset-2">';
                                        
                           
                                 echo '<div id="div_print">
              
                                        
                                        <div class="table-responsive">
                                              <table class="table table-hover" id="table">
                                                    <thead>
                                                      <tr>

                                                          <th>#</th>
                                                          <th>Fee Head</th>
                                                          <th>Payable</th>
                                                          <th>Paid</th>
                                                          <th>Balance</th>
                                                     
                                                          

                                                      </tr>
                                                    </thead>
                                                    <tbody>';

                                                        $sn = "";
                                                         $total_actual      = '';
                                                         $total_paid      = '';
                                                         $total_paid_calculated      = '';
                                                         $paid_amount_total = '';
                                                         $total_balance = '';
                                                         
                                                          foreach($result as $row):
                                                                $total_actual   += $row->actual_amount;
                                                                $total_paid     += $row->paid_amount;
                                                                $total_paid_calculated     += $row->actual_amount;
                                                                $total_balance  += $row->balance;
                                                                if($row->challan_status == 1):
                                                                    $paid_amount = '';
                                                                    $total_paid  = '';
                                                                endif;
                                                                
                                                                if($row->challan_status == 2):
                                                                    $paid_amount = $row->paid_amount;
                                                                endif;
                                                             
                                                                
                                                             
                                                                
                                                                
                                                                    
//                                                          $k = array_rand($class);
                                                           $sn++;
                                                        echo '<tr ">
                                                                <td>'.$sn.'</td>
                                                                <td>'.$row->fh_head.'</td>
                                                                <td>'.$row->actual_amount.'</td>
                                                                 
                                                                <th>'.$paid_amount.'</th>
                                                                 
                                                                <th>'.$row->balance.'</th>
                                                               </tr>';
                                                             
//                                                          if($challan_det):
//                                                               
//                                                             $paid_amount_total += $challan_det->amount;
//                                                              endif;
                                                        
                                                          endforeach;      
                                               
                                                           
                                                         echo '<tr>
                                                                <td> </td>
                                                                <td> </td>
                                                                <td>'.$total_paid_calculated.'</td>
                                                                
                                                                <th>'.$total_paid.'</th>
                                                               
                                                                <th>'.$total_balance.'</th>
                                                                   
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
 
   
  
 