        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            
            <div class="row cols-wrapper">
                 <div class="col-md-12">    
                       <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                              <span class="line">Report (<?php echo  $program?>)</span>
                        </h1>
                        <div class="section-content">
                           
                                <div class="row">
                                      <form class="form-inline course-finder-form" name="reportForm" method="post" accept-charset="utf-8">
                                    <div class="col-md-12">
                                        <div class="form-group ">   
                                            <?php
                                                echo form_input(array(
                                                    'name'          => 'emp_id_report',
                                                    'id'            => 'emp_id',
                                                    'class'         => 'form-control',
                                                    'placeholder'   => 'Employee name',
                                                    'type'          => 'text',
                                                    'required'      => 'required'
                                                    ));
                                                echo form_input(array(
                                                    'name'          => 'emp_idCode_report',
                                                    'id'            => 'emp_idCode',
                                                    'class'         => 'form-control',
                                                    'type'          => 'hidden'
                                                ));  
                                            ?>

                                      </div>
                                    
                                       
                                       
 

                                             
                                        <div class="form-group">
                                          <button type="submit" name="search" value="search" id="search" class="btn btn-theme">
                                            <i class="fa fa-search"></i> Search </button>
 
                                      </div>
                                    </div>  
                                       </form>                                </div>
                            
                                  
                                
                             
                             
                         </div><!--//section-content-->
                        
                        
                    </section>
          
                    </div>  
                
                
                <div class="col-md-12">
                    <div class="table-responsive">
                       <table class="table table-hover table-boxed" id="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Employee Name</th>
                            <th>Section Name</th>
                            <th>Subject Name</th>
                            <th><i class="icon-edit" style="color:#fff"></i><b> Details</b></th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                        if(@$result):
//                          echo '<pre>';print_r($result);die;
                            
                    $sn ='';
                    foreach($result as $rec):
                        $sn++;
                        ?>
                        <tr class="gradeA">
                            <td><?php echo $sn;?></td>
                            <td><?php echo $rec->employeename;?></td>
                            <td><?php echo $rec->sectionname;?></td>
                            <td><?php echo $rec->subjectname;?></td>
                            <td><a href="SARDR/<?php echo $rec->sectionId?>/<?php echo $rec->subject_id?>/<?php echo $rec->employeeId?>/<?php echo $rec->flag?>">Details</a></td>
                           
                        </tr>
                        <?php
                            endforeach; 
                            endif;
                            ?>
                    </tbody>
                </table>
                        <?php echo $print_log;?>
                    </div>
                   
                    
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
   