        <!-- ******CONTENT****** --> 
        <div class="content container" style="margin-bottom:200px;">
               <!-- ******BANNER****** -->
            <h2 align="left">All Sections <span  style="float:right"><a href="" data-toggle="modal" data-target="#adding" class="btn btn-large btn-primary">Add New Section</a></span><hr></h2>
            <div class="row">
            <div class="col-md-12">    
                       <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line">Sections Search</span>
                        </h1>
                        <div class="section-content" >
                            <div class="row">
                                <?php echo form_open('',array('class'=>'course-finder-form','name'=>'reportForm'));   ?>
                                  
                                    <div class="col-md-2">
                                        <label for="name">Select Program</label><br>
                                        <div class="form-group ">
                                            <?php 
                                                echo form_dropdown('programe_id', $program,$programe_id,  'class="form-control" id="feeProgrameId"');
                                            ?>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <label for="name">Sub Program</label><br>
                                        <div class="form-group ">
                                            <?php 
   
                                                    echo form_dropdown('sub_proId', $sub_program,$sub_pro_id,  'class="form-control sub_pro_id"  id="showFeeSubPro"');
                                            ?>
                                        </div>
                                    </div> 
                                    <div class="col-md-2">
                                        <label for="name">Batch</label><br>
                                        <div class="form-group ">
                                            <?php 
   
                                                    echo form_dropdown('batch', $batch,$batch_id,  'class="form-control sub_pro_id"  id="batch_id"');
                                            ?>
                                        </div>
                                    </div> 

                                    <div class="col-md-2 ">
                                        <label for="name">Select Section</label><br>
                                        <div class="form-group ">
                                            <?php 
    //                                        $Section = array('Section'=>"Section");
                                               echo form_dropdown('section_id', $section,$sec_id,  'class="form-control section" id="showSections"');    
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="name">Status</label><br>
                                        <div class="form-group">
                                            <select class="span8 tip form-control" id="showAlumiSubProSearch" name="sec_status">
                                                <option value="">Status</option>
                                                <option value="On" <?php if($status_id == 'On'): echo 'Selected'; endif;?> >On</option>
                                                <option value="Off" <?php if($status_id == 'Off'): echo 'Selected'; endif;?>>Off</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">&nbsp;</label><br>
                                        <button type="submit" name="search" value="search" id="search" class="btn btn-theme">
                                        <i class="fa fa-search"></i> Search </button>
<!--                                          <button type="submit" name="export" value="export" id="export" class="btn btn-theme">
                                        <i class="fa fa-download"></i> Export</button>-->
                                    </div>
                                 
                                <?php echo form_close(); ?>
                            </div>
                        </div><!--//section-content-->
                        
                    </section>
          
            </div></div>
            
            <div class="row cols-wrapper">
                <div class="col-md-12">
                    
                    <table id="testing123" border="0" class="datatable-1 table table-boxed table-bordered table-striped	 display" width="100%">
                    <thead>
                        <tr>
                            <th>Program</th>
                            <th>Sub Program</th>
                            <th>Batch</th>
                            <th>Section Name</th>
                            <th>Seat Allowed</th>
                            <th>Status</th>
                            <th><i class="icon-edit" style="color:#fff;"></i> Update</th>
                            <th><i class="icon-trash" style="color:#fff"></i><b> Delete</b></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach($result as $rec)  
                    {

                    ?>
                        <tr class="gradeA">
                            <td><?php echo $rec->program;?></td> 
                            <td><?php echo $rec->sub_program;?></td>
                            <td><?php echo $rec->batch;?></td>
                            <td><?php echo $rec->name;?></td>
                            <td><?php echo $rec->seats_allowed;?></td>
                            <td><?php echo $rec->status;?></td>
                            <td><a href="<?php echo base_url();?>admin/update_section/<?php echo $rec->sec_id;?>"><i class="icon-edit"></i><b> Update</b></a></td>
                            <td><a href="<?php echo base_url();?>admin/delete_section/<?php echo $rec->sec_id;?>" 
                                   onclick="return confirm('Are You Sure to Delete This..?')"><i class="icon-trash" style="color:#87a938"></i><b> Delete</b></a></td>
                        </tr>

                        <?php
}
                        ?>


                    </tbody>
                </table>
                    
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
   
  <div class="modal fade" id="adding" role="dialog" style="z-index:9999">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add New Section</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal row-fluid" method="post" enctype="multipart/form-data" action="<?php echo base_url();?>admin/add_section">
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Section Name</label>
                        <div class="controls">
                            <input type="text"  name="name" placeholder="Name Required" data-original-title="" class="span8 tip form-control">
                        </div>
                    </div>    
                    
                    <div class="control-group">
                        <label for="name">Program Name</label>
                        <div class="input-group" id="adv-search">
                            <?php
                            echo form_dropdown('program_id', $program,'',  'class="form-control" id="SecProgrameId"');
                                  ?>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label for="name">Batch</label>
                        <div class="input-group" id="adv-search">
                            <?php
                            echo form_dropdown('batch_id', $batch,'',  'class="form-control" id="Secbatch_id"');
                                  ?>
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label for="name">Sub Program</label>
                        <div class="input-group" id="adv-search">
                            <?php
                            echo form_dropdown('sub_pro_id', $subprogrames,'',  'class="form-control" id="SecSubPro"');
                                  ?>
                        </div>
                    </div>
                     <div class="control-group">
                        <label class="control-label" for="basicinput">Allowed Seats</label>
                        <div class="controls">
                            <input id="name" type="text" placeholder="Allowed Seats Required" name="seats_allowed" class="span8 tip form-control">                
                        </div>
                    </div>
                    
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Allowed Seats</label>
                        <div class="controls">
                        <select name="status" class=" form-control span8 tip">
                                <option>&larr; Status &rarr;</option>
                                <option value="On">On</option>
                                <option value="Off">Off</option>
                            </select>              
                        </div>
                    </div>
                     
                     
                    <br>
                    <div class="control-group">
                        <div class="controls">
                            <input type="submit" name="submit" value="Add Record" class="btn btn-primary pull-center">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
        
<script>
    
jQuery(document).ready(function(){
    
    
    
    jQuery('#SecProgrameId').on('click',function(){
    
     var programId = jQuery('#SecProgrameId').val();
     
        //get sub program
        jQuery.ajax({
         type   :'post',
         url    :'AdminDeptController/getSubProgram',
         data   :{'programId':programId},
         success :function(result){
            jQuery('#SecSubPro').html(result);
        },
        complete:function(){
           //payment category 
            
            
            
            
            //Get Batch 
            jQuery.ajax({
                type   :'post',
                url    :'feeController/getBatch',
                data   :{'programId':programId},
               success :function(result){
                   console.log(result);
                  jQuery('#Secbatch_id').html(result);
               }
            });
            
              
        }
        
     });
     
 });
    
    
    
    

//    jQuery("#section_find").autocomplete({  
//        minLength: 0,
//        source: "AttendanceController/auto_section/"+$("#section_find").val(),
//        autoFocus: true,
//        scroll: true,
//        dataType: 'jsonp',
//        select: function(event, ui){
//        jQuery("#section_find").val(ui.item.contactPerson);
//        jQuery("#section_id").val(ui.item.sec_id);
//        }
//        }).focus(function() {  jQuery(this).autocomplete("search", "");  });
});

</script>