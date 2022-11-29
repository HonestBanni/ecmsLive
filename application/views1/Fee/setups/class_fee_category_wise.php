 
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
                            <span class="line"><?php echo $page_header?> Search</span>
                        </h1>
                        <div class="section-content" >
                           <?php echo form_open('',array('class'=>'course-finder-form'));
                                  
                                     ?>
                                <div class="row">

                                       <div class="col-md-2 col-sm-5">
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
                                                    echo form_dropdown('sub_pro_id', $sub_program,$sub_pro_id,  'class="form-control" id="showFeeSubPro"');
                                               ?>
                                           </div>
                                       </div> 

                                         <div style="padding-top:2%;">
                                       <div class="col-md-2 pull-right">
                                           <button type="submit" class="btn btn-theme"  ><i class="fa fa-search"></i> Search  </button>

                                        </div>
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
                                                          <th>Program </th>
                                                          <th>Sub Program </th>
                                                          <th>Batch</th>
                                                          <th>Shift</th>
                                                          <th>Instalment Type</th>
                                                          <th>Amount</th>
                                                   

                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $sn = '';
                                                          foreach($result as $row):
                                                              
                                                           $sn++;
                                                            echo '<tr">
                                                                <th>'.$sn.'</th>
                                                                    <th>'.$row->programe_name.'</th>
                                                                <th>'.$row->name.'</th>
                                                                
                                                                <th>'.$row->batch_name.'</th>
                                                                <th>'.$row->shift_name.'</th>
                                                                <th>'.$row->title.'</th>
                                                                <th>'.$row->fcw_amount.'</th>
                                                                
                                                                  </tr>';
                                                         
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
 
 
 