        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">Group Chart Report
                <hr>
            </h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
                    <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line">Group Chart Search</span>
                        </h1>
                        <div class="section-content" >
                            <?php echo form_open('',array('class'=>'course-finder-form','action'=>'GroupStrengthReport')); ?>
                            <div class="row">
                                
                                <div class="col-md-3">
                                    <label for="name">Sub Program</label>
                                    <div class="form-group ">
                                        <?php echo form_dropdown('sub_pro_id', $sub_program,$sub_pro_id,  'class="form-control" id="SubProgram"'); ?>
                                    </div>
                                </div> 
                                
                                <div class="col-md-3">
                                    <label for="name">Section</label>
                                    <div class="form-group ">
                                        <?php echo form_dropdown('sect_id', $section,$section_id,  'class="form-control" id="secId"'); ?>
                                    </div>
                                </div> 
                            </div>
                             
                              
                           </div><!--//section-content-->
                                     
                                 
                            <div style="padding-top:1%;">
                                <div class="col-md-2 pull-left">
                                  </div>
                             
                                <div class="col-md-3 pull-right">
                                    <button type="submit" class="btn btn-theme" name="filter" id="filter"  value="filter" ><i class="fa fa-search"></i> Search</button> 
                                    <button type="submit" class="btn btn-theme" name="export_excel" id="filter"  value="filter" ><i class="fa fa-download"></i> Export</button>
                                  </div>
                            </div>
                            <?php
                            echo form_close();
                            ?>
                                
                        
                    </section>
                    
                    <div class="col-md-12">
                    </div>
                    
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-boxed table-bordered table-striped" width="100%">
                    <thead>
                        <tr>
                            <th width="5" style="vertical-align: text-bottom;">S No.</th>
                            <th width="80" style="vertical-align: text-bottom;">Sub Program</th>
                            <th width="80" style="vertical-align: text-bottom;">Section Name</th>
                            <th width="80" style="vertical-align: text-bottom;">Strength</th>
                            <!--<th width="45" style="vertical-align: text-bottom;"><i class="icon-edit" style="color:#fff"></i><b> Update</b></th>-->
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    $serial = 1;
                    foreach($result_g as $row):
                        echo '<tr> 
                            <td>'.$serial++.'</td>
                            <td>'.$row->sub_program.'</td>
                            <td>'.$row->section.'</td>
                            <td>';
                            $sec_id = $row->sec_id;
                            $s = $this->db->query("SELECT `student_record`.`student_name` FROM `student_record`,`student_group_allotment` WHERE `student_group_allotment`.student_id = student_record.student_id AND `section_id`='$sec_id' AND student_record.s_status_id='5'"); 
                            echo $s->num_rows();
                            echo '</td>
                        </tr>';
                    endforeach;
                    ?>
                    </tbody>
                </table>                
                
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
        
        <script>
            
    jQuery(document).ready(function(){
        jQuery('#SubProgram').on('change',function(){
            var sub_program_id= jQuery('#SubProgram').val();
            var programId = 1;
            jQuery.ajax({
                type   :'post',
                url    :'feeController/getSections',
                data   :{'sub_program_id':sub_program_id,'programId':programId},
                success :function(result){
                    console.log(result);
                    jQuery('#secId').html(result);
                }
            });
        });
    });
 
  </script>