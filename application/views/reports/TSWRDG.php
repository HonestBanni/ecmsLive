        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            
            <div class="row cols-wrapper">
                      <div class="col-md-12">    
                       <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line">Teach Report</span>
                        </h1>
                        <div class="section-content" >
                           
                                <div class="row">
                                      <?php echo form_open('',array('class'=>'form-inline course-finder-form','name'=>'reportForm'));   ?>
                                    <div class="col-md-12">
                                        <div class="form-group ">   
                                        <?php
                                        
                                        if(@$result):
                                          
                                            
                                             echo   form_input(array(
                                                'name'          => 'emp_id',
                                                'id'            => 'emp_id',
                                                'class'         => 'form-control',
                                                'placeholder'   => $empname,
                                                'type'          => 'text',
                                                
                                                ));
                                              echo form_input(array(
                                                'name'          => 'emp_idCode',
                                                'value'         => $empId,
                                                'id'            => 'emp_idCode',
                                                'class'         => 'form-control',
                                                'type'          => 'hidden'
                                                ));
                                            else:
                                              echo form_input(array(
                                                'name'          => 'emp_id',
                                                'id'            => 'emp_id',
                                                'class'         => 'form-control',
                                                'placeholder'   => 'Employee name',
                                                'type'          => 'text',
                                                'required'      => 'required'
                                                ));
                                            echo form_input(array(
                                                'name'          => 'emp_idCode',
                                                'id'            => 'emp_idCode',
                                                'class'         => 'form-control',
                                                'type'          => 'hidden'
                                                ));  
                                        endif;
                                           ?>

                                      </div>
                                        <div class="form-group ">   
                                        <?php
                                              form_input(array(
                                                'name'          => 'fromDate',
                                                'class'         => 'form-control',
                                                'placeholder'   => 'Date From',
                                                'type'          => 'date',
                                                'required'      => 'required'
                                                ));
                                           ?>

                                      </div>
                                        <div class="form-group ">   
                                        <?php
                                              form_input(array(
                                                'name'          => 'toDate',
                                                'class'         => 'form-control',
                                                'placeholder'   => 'to date',
                                                'type'          => 'date',
                                                'required'      => 'required'
                                                ));
                                          ?>

                                      </div>
 

                                             
                                        <div class="form-group">
                                          <button type="submit" name="search" value="search" id="search" class="btn btn-theme">
                                            <i class="fa fa-search"></i> Search </button>
 
                                      </div>
                                    </div>  
                                       <?php
                                    echo form_close();
                                    ?>
                                </div>
                            
                                  
                                
                             
                             
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
                            
                    $sn ='';
                    foreach($result as $rec):
                        $sn++;
                        ?>
                        <tr class="gradeA">
                            <td><?php echo $sn;?></td>
                            <td><?php echo $rec->employeename;?></td>
                            <td><?php echo $rec->sectionname;?></td>
                            <td><?php echo $rec->subjectname;?></td>
                            <td><a href="TSWRDS/<?php echo $rec->sectionId?>/<?php echo $rec->subject_id?>/<?php echo $rec->employeeId?>">Details</a></td>
                           
                        </tr>
                        <?php
                            endforeach; 
                            endif;
                            ?>
                    </tbody>
                </table> 
                    </div>
                   
                    
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
   