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
                                <div class="col-md-4 col-sm-5">
                                          <label for="name">Date</label>
                                        
                                          
                                                <?php
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'date',
                                                                'required'      => 'required',
                                                                'value'         => date('d-m-Y',strtotime($result->d_action_date)),
                                                                'class'         => 'form-control datepicker',
                                                                'placeholder'   => 'Date',
                                                                 )
                                                             );
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'student_id',
                                                                'type'          => 'hidden',
                                                                'class'         => 'form-control',
                                                                'value'         => $this->uri->segment(3),
                                                                 )
                                                             );
                                                    echo  form_input(
                                                             array(
                                                                'name'          => 'action_id',
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
                                                   'value'          => $result->d_action_details,
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