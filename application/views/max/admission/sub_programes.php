        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">All Sub Programes <span style="float:right"><a href="" data-toggle="modal" data-target="#adding" class="btn btn-large btn-primary">Add New Sub Programe</a></span><hr></h2>
            
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
    //                                        $sub_program = array('Sub Program'=>"Sub Program");
                                                    echo form_dropdown('sub_proId', $sub_program,$sub_pro_id,  'class="form-control sub_pro_id"  id="showFeeSubPro"');
                                            ?>
                                        </div>
                                    </div> 

                                    <div class="col-md-2">
                                        <label for="name">Program Type</label><br>
                                        <div class="form-group">
                                            <select class="span8 tip form-control" id="showAlumiSubProSearch" name="sp_type">
                                                <option value="">Status</option>
                                                <option value="1">Section Based</option>
                                                <option value="2">Subject Based</option>
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
            
            <div class="row cols-wrapper">
                <div class="col-md-12">
                    
                    <table id="testing123" border="0" class="datatable-1 table table-boxed table-bordered table-striped	 display" width="100%">
                    <thead>
                        <tr>
                            <th>Sub Program</th>
                            <th>Program</th>
                            <th>Status</th>
                            <th>Section / Subject</th>
                            <th><i class="icon-edit" style="color:#fff;"></i> Update</th>
                            <th><i class="icon-trash" style="color:#fff"></i><b> Delete</b></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach($sub_result as $srec)  
                    {

                    ?>
                        <tr class="gradeA">
                            <td><?php echo $srec->name;?></td> 
                            <td><?php echo $srec->program;?></td>
                            <td><?php echo $srec->status;?></td>
                            <td>
                                <?php if($srec->flag == 1): echo 'Section Based'; endif; ?>
                                <?php if($srec->flag == 2): echo 'Subject Based'; endif; ?>
                            </td>
                            <td><a href="<?php echo base_url();?>admin/update_sub_programe/<?php echo $srec->sub_pro_id;?>"><i class="icon-edit"></i><b> Update</b></a></td>
                            <td><a href="<?php echo base_url();?>admin/delete_sub_programe/<?php echo $srec->sub_pro_id;?>" 
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
                <h4 class="modal-title">Add New Sub Program</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal row-fluid" method="post" enctype="multipart/form-data" action="<?php echo base_url();?>admin/add_sub_programe">

                    <div class="control-group">
                        <label class="control-label" for="basicinput">Sub Program Name</label>
                        <div class="controls">
                            <input type="text"  name="name" placeholder="Type Required" data-original-title="" class="span8 tip form-control">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Program</label>
                        <div class="controls">
                            <select name="programe_id" class=" form-control span8 tip" required>
                                <option>&larr; Programe &rarr;</option>
                        <?php
                $p = $this->db->query("SELECT * FROM programes_info");
                foreach($p->result() as $pr)
                        {        
                        ?>        
                                <option value="<?php echo $pr->programe_id;?>"><?php echo $pr->programe_name;?></option>
                        <?php
                            }
                            ?>    
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Status</label>
                        <div class="controls">
                            <select name="status" class="form-control span8 tip">
                                <option>&larr; Status &rarr;</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Section/Subject</label>
                        <div class="controls">
                            <select name="flag" class="form-control span8 tip">
                                <option value="">Select</option>
                                <option value="1">Section Base</option>
                                <option value="2">Subject Base</option>
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