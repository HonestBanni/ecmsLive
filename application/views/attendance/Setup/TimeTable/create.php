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
                              <form method="post" action="AttendanceController/add_class_alloted">     
                                    <div class="col-md-12">
                                         <h4 style="color:red; text-align:center;">
                                            <?php print_r($this->session->flashdata('msg'));?>
                                        </h4>  
                            <div class="form-group col-md-4">
                                <!--<lable for="name">Employee</lable>-->
                                <label for="name">Employee</label>
                                
                               <input type="text" name="emp_id" class="form-control" id="EmployeeNameWithSubjectAuto">
                                <input type="hidden" name="emp_id" id="EmployeeNameAutoId">
                            </div>
                             <div class="form-group col-md-3">
                                <lable for="name">Section</lable>
                                <input type="text" name="sec_id" class="form-control" id="sec">
                                <input type="hidden" name="sec_id" id="sec_id">
                            </div>
                            <div class="form-group col-md-3">
                                <lable for="name">Subject</lable>
                               <input type="text" name="subject_id" class="form-control" id="sub">
                                <input type="hidden" name="subject_id" id="subject_id">
                                <input type="hidden" name="subject_flag" id="subject_flag">
                            </div>             
                                      
                            </div>
                            <div class="col-md-12">
                                     <div class="form-group col-md-2">
                                         <lable for="name">Day</lable>
                                        <select class="form-control" name="day_id" id="day_id">
                                            <option value="">Select Day</option>
                                            <?php 
                                            $d = $this->CRUDModel->getResults('days');
                                            foreach($d as $rec):
                                            ?>
                                            <option value="<?php echo $rec->day_id;?>"><?php echo $rec->day_name;?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <lable for="name">Start Time</lable>
                                        <?php
                                        if($start_time):
                                            echo form_dropdown('stime_id', $start_time,'',  'class="form-control" required="required" id="stime_id"');
                                        endif;
                                        
                                        ?>
<!--                                    <select class="form-control" name="stime_id" id="stime_id">
                                            <option value="">Start Time</option>
                                            <?php 
                                            
                                            $d = $this->CRUDModel->getResults('class_starting_time');
                                            foreach($d as $rec):
                                            ?>
                                            <option value="<?php echo $rec->stime_id;?>"><?php echo $rec->class_stime;?></option>
                                            <?php endforeach;?>
                                        </select>  -->
                                    </div>
                                <div class="form-group col-md-2">
                                    <lable for="name">End Time</lable>
                                      <?php
                                        if($end_time):
                                            echo form_dropdown('etime_id', $end_time,'',  'class="form-control" required="required" id="etime_id"');
                                        endif;
                                        
                                        ?>
<!--                                    <select class="form-control" name="etime_id" id="etime_id">
                                            <option value="">End Time</option>
                                             
                                            <?php 
                                            $d = $this->CRUDModel->getResults('class_ending_time');
                                            foreach($d as $rec):
                                            ?>
                                            <option value="<?php echo $rec->etime_id;?>"><?php echo $rec->class_etime;?></option>
                                            <?php endforeach;?>
                                        </select>-->
                                    </div> 
                                 <div class="form-group col-md-2">
                                <lable for="name">Building Block</lable>
                                 <?php 
                                    echo form_dropdown('building_block', $building_block,$building_block_id,  'class="form-control required="required" id="building_block"');
                                ?>

                            </div>             
                            <div class="form-group col-md-2">
                                <lable for="name">Rooms</lable>

                               <?php 
                                    $rooms = 'Select Room';
                                    echo form_dropdown('rooms', $rooms,'',  'class="form-control required="required" id="rooms"');
//                                    echo form_dropdown('rooms', $rooms,$rooms_id,  'class="form-control required="required" id="rooms"');
                                ?>

                            </div>  
                                <div style="padding-top:1.5%;">
                                    
                                    <div class="col-md-4">
                                        <input type="button" name="submit" id="addClass" value="Add" class="btn btn-theme">
                                    </div>
                                </div>
                                     <div class="col-md-6">
                                <input type="submit" class="btn btn-theme" name="submit_timetable" value="Add Class Allotted">
                            </div>
                            <input type="hidden" name="form_Code" id="form_Code" value="<?php $rand = rand(1,10000000); $date = date('YmdHis');
                                    echo md5($rand.$date);
                                    ?>">            
                                    </div>
                            </form> 
                        </div>
                </section>
                    
                </div>
            </div>
        </div>
    </div>
</div>



<!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            
            <div class="row cols-wrapper">
  
                <article class="contact-form col-md-12 col-sm-7">
                    <div id="timeTable">

                    </div>
                  </article> 
                    </div>
    
               </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
         <script>
            jQuery(document).ready(function(){
               function show(){}
            }); 
        
        </script>
        <script>
            jQuery(document).ready(function(){
                
                jQuery('#building_block').on('change',function(){
                    var building_block = jQuery('#building_block').val();
                    
                    jQuery.ajax({
                        type    : 'post',
                        url     : 'GetInvtRooms',
                        data    : {'building_block':building_block},
                        success : function(result){
                            jQuery('#rooms').html(result);
                        }
                    });
                });
                
                
            });
        </script>    