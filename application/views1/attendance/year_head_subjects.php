
<!-- ******CONTENT****** --> 
<div class="content container">
  <div class="page-wrapper">
    <header class="page-heading clearfix">
      <h1 class="heading-title pull-left">Year Head Subject Allotments  
      </h1>
      <div class="breadcrumbs pull-right">
        <ul class="breadcrumbs-list">
          <li class="breadcrumbs-label">You are here:
          </li>
          <li> 
            <?php echo anchor('admin/admin_home', 'Home');?> 
            <i class="fa fa-angle-right">
            </i>
          </li>
          <li class="current">Year Head Subject Allotments  
        </ul>
      </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
      <div class="row">
           <?php echo form_open('',array('class'=>'form-inline course-finder-form','name'=>'reportForm'));   ?>
        <section class="course-finder">
            
                        <h1 class="section-heading text-highlight">
                            <span class="line">Year Head Subject Allotments Search</span>
                        </h1>
                        <div class="section-content" >
                           
                              
                                     
                              <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group ">   
                                        <?php
                                            echo form_input(array(
                                                'name'          => 'college_no',
                                                
                                                'class'         => 'form-control',
                                                'placeholder'   => 'College #',
                                                'type'          => 'text'
                                                ));
                                             ?>

                                      </div>
                                        <div class="form-group ">   
                                        <?php
                                            echo form_input(array(
                                                'name'          => 'student_name',
                                                'id'            => 'student_name',
                                                'class'         => 'form-control',
                                                'placeholder'   => 'Student name ',
                                                'type'          => 'text'
                                                ));
                                             ?>

                                      </div>
                                        <div class="form-group ">   
                                        <?php
                                            echo form_input(array(
                                                'name'          => 'father_name',
                                                'id'            => 'father_name',
                                                'class'         => 'form-control',
                                                'placeholder'   => 'Father name ',
                                                'type'          => 'text'
                                                ));
                                             ?>
                                        </div>
                                        <div class="form-group">   
                                        <?php
                                           echo form_dropdown('sub_proId',$subprogrames,'','class="form-control" id="sub_proId"');
                                        ?>
                                        </div>
                                        <div class="form-group">   
                                        <select class="span8 tip form-control" id="showSession" name="session_id">
                                                    <option value="">Select Session</option>
                                            </select>
                                        </div>
                                        
                                    
                                     
                                </div>
                                  <div class="col-md-12 ">
                                      <div class="form-group">
                                    
                                        <div class="form-group">
                                          <button type="submit" name="search" value="search" id="search" class="btn btn-theme"><i class="fa fa-search"></i> Search </button>
                                        </div>
                                    </div>  
                                  </div>
                               
                                  <?php
                                  
                                  if(@$searchResult):
                                  ?>
                                    <div class="col-md-12 ">
                                       <div class="form-group">   
                                         
                                           
                                           <?php
                                            echo form_dropdown('subject_id',$subject,'','class="form-control" id="my_id"');
                                        ?>
                                        </div> 
                                  
                                  </div> 
                                     <div class="col-md-12 ">
                                      <div class="form-group">
                                          <input type="hidden" name="sectionId" value="<?php
                                          
                                          
                                          if(@$sec_id){echo $sec_id;}?>">
                                          
                                          
                                        <div class="form-group">
                                          <button type="submit" name="saveSearch" value="saveSearch" class="btn btn-theme"><i class="fa fa-save"></i> save </button>
                                        </div>
                                      
                                    </div>  
                                  </div> 
                                  <?php
                                  endif;
                                  ?>
                                  
                              </div> 
                            
                                         
                              
        </section>
          <div class="table-responsive">
              <h3 class="has-divider text-highlight">Total Record : <?php if(!empty($searchResult)): echo count($searchResult); endif;?></h3>
              <?php
              if($this->session->flashdata('subject_msg')):
                  
            
              
              ?>
              <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">?</button>
                <?php
                
                print_r($this->session->flashdata('subject_msg'));
                
                ?>
            </div>
              <?php
                endif;
                ?>
            <table class="table table-hover table-boxed" id="table">
                <?php 
                
                 if(@$searchResult):
                     ?>
                
                <thead>
                        <tr>
                                                        <th>#</th>
                            <th><input type="checkbox" id="checkAll"></th>
                            <th>Picture</th>

                            <th>College#</th>
                            <th>Student name</th>
                            <th>Father name</th>
                            <th>Section</th>
                  
                        </tr>
                    </thead>  
                    <tbody>
                <?php
                
               $sn = '';
                    foreach($searchResult as $StdRow):
                    
                 $sn++;
                ?>
                    <tr class="gradeA">
                             <td><?php echo $sn;?></td>
                            <td>
                                <input type="checkbox" name="checked[]" value="<?php echo $StdRow->student_id?>" id="checkItem">
                                <input type="hidden" name="student_id">
                                </td>
                                <td><?php 
                                
                                if($StdRow->applicant_image):
                                    echo ' <img src="http://localhost:8080/ECMS/assets/images/students/'.$StdRow->applicant_image.'" width="60" height="60">';
                                    else:
                                       echo ' <img src="http://localhost:8080/ECMS/assets/images/students/user.png" width="60" height="60">';
                                endif;
                
                                
                                
                                ?>
                                   
                                </td>       
                            <td><?php echo $StdRow->college_no;?></td>
                            <td><?php echo $StdRow->student_name;?></td>
                            <td><?php echo $StdRow->father_name;?></td>
                            <td><?php echo $StdRow->sections_name;?></td>
                          
                     </tr>
                 <?php
                    
                    endforeach;
                    endif;
                    ?>
                </tbody>
            </table> 
            </div>
            <?php
                                    echo form_close();
                                    ?>
      </div>
            
        <!--//page-row-->
      </div>
      <!--//page-content-->
    </div>
    <!--//page-wrapper--> 
  </div>
  <!--//content-->
 
 