 
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
                                <div class="col-md-3">
                                    <label for="name">Program</label>
                                 
                                        <?php 
                                            echo form_dropdown('programe_id', $program,$programe_id,  'class="form-control required="required" feeProgrameId" id="feeProgrameId"');
                                        ?>
                                    
                                </div>
                                <div class="col-md-3">
                                    <label for="name">Sub Program</label>
                                  
                                        <?php 
                                                 echo form_dropdown('sub_pro_id', $sub_program,$sub_pro_id,  'class="form-control" id="showFeeSubPro"');
                                        ?>
                                     
                                </div>
                                <div class="col-md-3">
                                    <label for="name">Batch</label>
                                        <?php
                                             
                                            echo form_dropdown('batch_id', $batch,$batch_id,'class="form-control"  id="batch_id"');
                                        ?>
                                </div>    
                                 
                                
                                     
                                    <div class="col-md-3">
                                              <label for="name">Gender</label>
                                            <?php 
                                              echo form_dropdown('gender',$gender,$gender_id,  'class="form-control"');
                                         ?>
                                    </div>
                                 
                                      
                                    <div class="col-md-3 col-sm-5">
                                          <label for="name">Student From O.Marks</label>
                                         
                                                <?php
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'std_no_from',
                                                                'type'          => 'text',
                                                                'value'         => $std_no_from,
                                                                'class'         => 'form-control',
                                                                'placeholder'   => 'Student Numbers From',
                                                                 )
                                                             );
                                                      ?>
                                             
                                            
                                     </div>
                                 <div class="col-md-3 col-sm-5">
                                          <label for="name">Student No O.Marks</label>
                                        
                                       
                                                <?php
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'std_no_to',
                                                                'type'          => 'text',
                                                                'value'         => $std_no_to,
                                                                'class'         => 'form-control',
                                                                'require'       => 'require',
                                                                'placeholder'   => 'Student Numbers To',
                                                                 )
                                                             );
                                                      ?>
                                              
                                            
                                     </div>
                                      
                                    
                                      
                                     </div>
                            
                                    <div class="row">
                                        <div class="col-md-3">
                                              <label for="name">Update to Shift</label>
                                            <?php echo form_dropdown('student_shift',$shift,'',  'class="form-control"');?>
                                        </div>
                                        <div class="col-md-4 pull-right">
                                            <label for="name"  style="visibility: hidden;">Student Shiftsdfasdfsadfasfa fsdfs sf sdfsfsa</label>
                                                <button type="submit" class="btn btn-theme" name="GenerateChallanNewAdmission" id="GenerateChallanNewAdmission"  value="GenerateChallanNewAdmission" ><i class="fa fa-search"></i> Search</button>
                                                <button type="submit" class="btn btn-theme" name="update_shift"  value="update_shift" ><i class="fa fa-save"></i> Update Shift</button>
                                        </div>
                                    </div>
                                </div>
                           
                          
                                    
                             
                            
                         </div><!--//section-content-->
                        
                        
                    </section>
                    <?php
                    
                     echo '<div class="row">
              <div class="col-md-12">';
                                        
                      
                                      if(!empty($result)):
                                        echo '  <div id="div_print">
                                                <h3 class="has-divider text-highlight">Result :'; echo count($result); echo '</h3>
                                                    <div class="table-responsive">
                                                    <table class="table table-hover" id="table" style="font-size:10px;">
                                                    <thead>
                                                      <tr>

                                                          <th><input type="checkbox" id="checkAll" checked="checked"></th>
                                                          <th>#</th>
                                                          <th>Form#</th>
                                                          <th>College#</th>
                                                          <th>Student Name </th>
                                                          <th>Father Name</th>
                                                          <th>Program</th>
                                                          <th>Sub Program</th>
                                                          <th>Shift</th>
                                                          <th>Batch Name</th>
                                                          <th>Marks Details</th>
                                                          <th>Status</th>
                                                          

                                                      </tr>
                                                    </thead>
                                                    <tbody>';
                                                            $sn = "";
                                                            foreach($result as $row):
                                                                 
                                                                
                                                            $sn++;
                                                                echo '<tr">
                                                                <th><input type="checkbox" name="studentIds[]" value="'.$row->student_id.'"   id="checkItem" checked="checked"></th>
                                                                <th>'.$sn.'</th>
                                                                <th>'.$row->form_no.'</th>
                                                                <th>'.$row->college_no.'</th>
                                                                <th>'.$row->student_name.'</th>
                                                                <th>'.$row->father_name.'</th>
                                                                <th>'.$row->programe_name.'</th>
                                                                <th>'.$row->SubProgram.'</th>
                                                                <th>'.$row->StudentShift.'</th>
                                                                <th>'.$row->batch_name.'</th>
                                                                <th>'.$row->obtained_marks.' / '.$row->total_marks.'</th>
                                                                <th>'.$row->current_status.'</th>
                                                                </tr>';
                                                            endforeach;      
                                                            echo'</tbody>
                                            </table>
                                        </div>';
                                          
                                      endif;
                                    
                                    echo '</div>
                                    </div>
                                  
                                </div>';
                    
                     
                                    echo form_close();
                                    ?>
                                         
                                </div>
 
          </div>
          
      
      </div>
</div>
 
 
 
         
  
 