<style>
    input[type=checkbox]{
    zoom: 1.8;
    }
</style> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left"><?php echo $page_header?><hr></h2>
            <h3 style="color:red; text-align:center;">
                <?php print_r($this->session->flashdata('del_msg'));?>
            </h3>   
            <div class="row cols-wrapper">
                      <div class="col-md-12">    
                       <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line"><?php echo $page_header?> Search</span>
                        </h1>
                        
                        <div class="section-content" >
                           
            <div class="row">
              <?php echo form_open('',array('class'=>'form-inline course-finder-form','name'=>'reportForm'));   ?>
            <div class="col-md-12">
                
            <div class="form-group">
                
                
                    <?php 
                            echo form_dropdown('program_id', $program, $program_id,  'class="form-control" id="feeProgrameId"');
                    ?>
                               
            </div>
            <div class="form-group">
               
                <?php 
                            echo form_dropdown('sub_program_id', $subprogrames, $sub_pro_id,  'class="form-control" id="showFeeSubPro"');
                    ?>
                 
            </div>
            <div class="form-group">
                <?php 
                            echo form_dropdown('sec_id', $sections, $sec_id,  'class="form-control" id="showSections"');
                    ?>
                
                              
            </div>
                <div class="form-group">
             <?php        

                if(!empty($emp_id)){
                    $rooms = $this->CRUDModel->get_where_result('hr_emp_record',array('emp_id'=>$emp_id));
                    foreach($rooms as $roomrec)
                    { ?>          
                        <input type="text" name="emp_id" value="<?php echo $roomrec->emp_name; ?>" placeholder="Employee Name" class="form-control" id="emp">
                        <input type="hidden" name="emp_id" id="emp_id" value="<?php echo $roomrec->emp_id; ?>">      
                    <?php 
                    }     
                }else{?>
                        <input type="text" name="emp_id" class="form-control" placeholder="Employee Name" id="emp">
                        <input type="hidden" name="emp_id" id="emp_id">
                    <?php
                    }    
                ?>                  
            </div>
                
            <div class="form-group">
            <?php        

                if(!empty($subject_id)){
                    $subj = $this->CRUDModel->get_where_result('subject',array('subject_id'=>$subject_id));
                    foreach($subj as $subjrec)
                    { ?>          
        <input type="text" name="subject_id" value="<?php echo $subjrec->title; ?>" placeholder="Subject Name" class="form-control" id="sub">
                    <input type="hidden" name="subject_id" id="subject_id" value="<?php echo $subjrec->subject_id; ?>">      
                    <?php 
                    }     
                }else{?>
        <input type="text" name="subject_id" class="form-control" placeholder="Subject Name" id="sub">
            <input type="hidden" name="subject_id" id="subject_id">        
        
                    <?php
                    }    
                ?>                  
            </div>   
            <div class="form-group">
        <input type="submit" name="submit" value="Search" class="btn btn-theme">
          </div>
                                    </div>  
                                       <?php
                                    echo form_close();
                                    ?>
                                </div>
                            
                                  
                                
                             
                             
                         </div><!--//section-content-->
                        
                        
                    </section>
          
                    </div>
                <?php
                if(!empty($result)):
                ?>
            <form method="post" action="ClassAllotedDelete">    
                <div class="col-md-12">
                    <div class="table-responsive">
                        <p>
        <input type="submit" class="btn btn-danger" name="delete" value="Delete" onclick="return confirm('Are You Want to Delete This..?')">                 
            <button type="button" class="btn btn-success">
                <i class="fa fa-check-circle"></i>Total Records: <?php echo count(@$result);?>
            </button>                   
            </p>
                       <table class="table table-hover table-boxed">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="checkAll"></th>
                            <th>S/No</th>
                            <th>Employee Name</th>
                            <th>Sub Program</th>
                            <th>Section Name</th>
                            <th>Subject Name</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php
                    $i=1;
                    foreach($result as $rec){
                        ?>
                        <tr class="gradeA">
                            <td>
    <input type="checkbox" name="checked[]" value="<?php echo $rec->class_id;?>" id="checkItem">
                            <input type="hidden" name="class_id"></td>
                            <td><?php echo $i;?></td>
                            <td><?php echo $rec->employee;?></td>
                            <td><?php echo $rec->name;?></td>
                            <td><?php echo $rec->section;?></td>
                            <td><?php echo $rec->subject;?></td>
                        </tr>

                        <?php
                        $i++;
                        }
                        ?>
                    </tbody>
                </table>
                  
                    </div> 
                </div><!--//col-md-3-->
                <?php
                endif;
                ?>
                </form>    
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
   