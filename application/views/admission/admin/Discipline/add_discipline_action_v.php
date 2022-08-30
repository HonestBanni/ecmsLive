        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left"><?php echo $page_header?><hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
                    <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line"><?php echo $page_header?> Panel</span>
                        </h1>
                        <div class="section-content" >
                           <?php echo form_open('',array('class'=>'course-finder-form','id'=>'print_wise_form'));
                                  
                                     ?>
                                <div class="row">
                                    <div class="col-md-2 col-sm-5">
                                          <label for="name">Form#</label>
                                            <?php
                                                    echo  form_input(
                                                             array(
                                                                'readonly'      =>'readonly',
                                                                'value'         => $student_info->form_no,
                                                                'class'         => 'form-control',
                                                                
                                                                 )
                                                             );
                                                    
                                                      ?>
                                        </div>
                                    <div class="col-md-3 col-sm-5">
                                          <label for="name">Student Name</label>
                                            <?php
                                                    echo  form_input(
                                                             array(
                                                                'readonly'      =>'readonly',
                                                                'value'         => $student_info->student_name,
                                                                'class'         => 'form-control',
                                                                
                                                                 )
                                                             );
                                                    
                                                      ?>
                                        </div>
                                 
                                    <div class="col-md-3 col-sm-5">
                                          <label for="name">Father Name</label>
                                            <?php
                                                    echo  form_input(
                                                             array(
                                                                'readonly'      =>'readonly',
                                                                'value'         => $student_info->father_name,
                                                                'class'         => 'form-control',
                                                                
                                                                 )
                                                             );
                                                    
                                                      ?>
                                        </div>
                                 
                                    <div class="col-md-2 col-sm-5">
                                          <label for="name">College no</label>
                                            <?php
                                                    echo  form_input(
                                                             array(
                                                                'readonly'      =>'readonly',
                                                                'value'         => $student_info->college_no,
                                                                'class'         => 'form-control',
                                                                
                                                                 )
                                                             );
                                                    
                                                      ?>
                                        </div>
                                    <div class="col-md-2 col-sm-5">
                                          <label for="name">Sectino</label>
                                            <?php
                                                    echo  form_input(
                                                             array(
                                                                'readonly'      =>'readonly',
                                                                'value'         => $student_info->sectionsName,
                                                                'class'         => 'form-control',
                                                                
                                                                 )
                                                             );
                                                    
                                                      ?>
                                        </div>
                                </div>
                                <div class="row">
                                <div class="col-md-3 col-sm-5">
                                          <label for="name">Date</label>
                                        
                                          
                                                <?php
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'date',
                                                                'required'      => 'required',
                                                                'value'         => date('d-m-Y'),
                                                                'class'         => 'form-control datepicker',
                                                                'placeholder'   => 'Date',
                                                                 )
                                                             );
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'student_id',
                                                                'type'          => 'hidden',
                                                                'class'         => 'form-control',
                                                                'value'         => $this->uri->segment(2),
                                                                 )
                                                             );
                                                      ?>
                                            
                                            
                                     </div>
                                 
                                    <div class="col-md-12">
                                    <label for="name">Discipline Action</label>
                                     
                                        <?php
                                        echo form_textarea(
                                                array(
                                                   'name'          => 'action',
                                                   'class'         => 'form-control',
                                                   'placeholder'   => 'Discipline Action Details',
                                                    )
                                                );
                                        ?>
                                    
                                </div> 
                                          
                                 
                         
                                 
                            </div>
                             
                              
                           </div><!--//section-content-->
                                     
                                 
                            <div style="padding-top:1%;">
                              
                                <div class="col-md-2 pull-right">
                                    <button type="submit" class="btn btn-theme" name="Save" id="Save"  value="Save" ><i class="fa fa-plus"></i> Save</button>
                                  </div>
                            </div>
                                    <?php
                                    echo form_close();
                                    ?>
                                
                             
                            
                        
                        
                        
                    </section>
                    
                    <div class="col-md-12">
                        
                    </div>
                      
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-boxed table-bordered table-striped	 display" width="100%">
                    <thead>
                        <tr>
                            <th width="5">S/N</th>
                            <th width="40">College #</th>
                            <th width="60">Student</th>
                            <th width="60">F-Name</th>
                            <th width="50">Action Dateo</th>
                            <th width="150">Action Details</th>
                            <th width="40">Manage</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                   $sn = '';     
    foreach($result as $rec):
                $sn++;
                    echo '<td>'.$sn.'</td>';
                    echo '<td>'.$rec->college_no.'</td>';
                    echo '<td>'.$rec->student_name.'</td>';
                    echo '<td>'.$rec->father_name.'</td>';
                    echo '<td>'.date('d-M-Y',strtotime($rec->d_action_date)).'</td>';
                    echo '<td>'.$rec->d_action_details.'</td>';
                    echo '<td>';
                    
                    if($rec->status == 1):
                        echo '<a href="UpdateAction/'.$rec->id.'/'.$rec->student_id.'" class="btn btn-success">Update<a/> &nbsp;';
                        echo '<a href="DisabledAction/'.$rec->id.'/'.$rec->student_id.'" class="btn btn-danger">Disabled<a/>';
                        else:
                        
                    endif;
                    echo '</td>';
                    
                  echo '</tr>';    
        
            endforeach;
             ?>

                    </tbody>
                </table>                
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
            <script>
  $( function() {
     $('.datepicker').datepicker( {
               changeMonth: true,
                changeYear: true,
                 dateFormat: 'dd-mm-yy'
           
            });
  } );
  </script>
  <style>
      .datepicker{
          z-index: 5;
      }
  </style> 