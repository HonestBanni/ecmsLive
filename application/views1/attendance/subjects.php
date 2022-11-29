        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">All Subjects List <span  style="float:right"><a href="" data-toggle="modal" data-target="#adding" class="btn btn-large btn-primary">Add New Subject</a></span><hr></h2>
            <div class="row cols-wrapper">
                                      <div class="col-md-12">    
                       <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line">All Subjects List Search</span>
                        </h1>
                        <div class="section-content" >
                           
                                <div class="row">
                                      <?php echo form_open('',array('class'=>'form-inline course-finder-form','name'=>'reportForm'));   ?>
                                    <div class="col-md-12">
                                        
                                        <div class="form-group">

                                                <?php
                                                  echo form_input(array(
                                                  'name'          => 'sub',
                                                  'id'            => 'sub',
                                                  'value'         => '',
                                                  'class'         => 'form-control',
                                                  'placeholder'   => 'Subject Name',
                                                  'type'          => 'text',
                                                  ));

                                                  echo form_input(array(
                                                  'name'          => 'subject_id',
                                                  'id'            => 'subject_id',
                                                  'value'         => '',
                                                  'class'         => 'form-control',
                                                 'type'          => 'hidden',
                                                  ));
                                              ?>



                                           </div>
                                        <div class="form-group ">
                                            <select class="span8 tip form-control" id="alumiProgrameIdSearch" name="program_id">
                                                <option value="">Select Program</option>
                                                <?php
                                                $q = $this->db->query("SELECT * FROM programes_info");
                                               foreach($q->result() as $rec){
                                               ?>
                                                <option value="<?php echo $rec->programe_id;?>"><?php echo $rec->programe_name;?></option>
                                               <?php 
                                               }
                                               ?>
                                           </select>
                                          
                                        <?php
//                                            echo form_input(array(
//                                                'name'          => 'program_Name',
//                                                'id'            => 'program_Name',
//                                                'class'         => 'form-control',
//                                                'placeholder'   => 'Program name',
//                                                'type'          => 'text'
//                                                ));
//                                            echo form_input(array(
//                                                'name'          => 'program_id',
//                                                'id'            => 'program_id',
//                                                'class'         => 'form-control',
//                                                'type'          => 'hidden'
//                                                ));?>
                                            

                                      </div>
                                        <div class="form-group">
                                            
                                            <select class="span8 tip form-control" id="showAlumiSubProSearch" name="sub_proId">
                                                    <option value="">Select Sub Program</option>
                                            </select>

                                                                     <?php
//                                                  echo form_input(array(
//                                                  'name'          => 'sub_pro',
//                                                  'id'            => 'sub_pro',
////                                                  'name'          => 'sub_proName',
////                                                  'id'            => 'sub_proName',
//                                                  
//                                                  'class'         => 'form-control',
//                                                  'placeholder'   => 'Sub program',
//                                                  'type'          => 'text',
//                                                  ));
//
//                                                  echo form_input(array(
//                                                  'name'          => 'sub_proId',
//                                                  'id'            => 'sub_proId',
////                                                  'name'          => 'sub_proNameId',
////                                                  'id'            => 'sub_proNameId',
//                                                  
//                                                  'class'         => 'form-control',
//                                                 'type'             => 'hidden',
//                                                  ));
                                              ?>



                                           </div>

                                        

                                             
                                        <div class="form-group">
                                          <button type="submit" name="search" value="search" id="search" class="btn btn-theme">
                                            <i class="fa fa-search"></i> Search </button>
<!--                                          <button type="submit" name="export" value="export" id="export" class="btn btn-theme">
                                            <i class="fa fa-download"></i> Export</button>-->
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
                    
                    <table id='testing123' cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-boxed table-bordered table-striped	 display" width="100%">
                    <thead>
                        <tr>
                            <th>Subject Name</th>
                            <th>Program</th>
                            <th>Sub Program</th>
                            <th><i class="icon-edit" style="color:#fff"></i><b> Update</b></th>
                            <th><i class="icon-trash" style="color:#fff"></i><b> Delete</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                    foreach($result as $rec)  
                    {
                        ?>
                        <tr class="gradeA">
                            <td><?php echo $rec->subject;?></td>
                            <td><?php echo $rec->program;?></td>
                            <td><?php echo $rec->sub_program;?></td>
                            <td><a href="<?php echo base_url();?>AttendanceController/update_subject/<?php echo $rec->subject_id;?>"><i class="icon-edit"></i><b> Update</b></a></td>
                            <td><a href="<?php echo base_url();?>AttendanceController/delete_subject/<?php echo $rec->subject_id;?>" 
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
                <h4 class="modal-title">Add New Subject</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal row-fluid" method="post" enctype="multipart/form-data" action="<?php echo base_url();?>AttendanceController/add_subject">

                    <div class="control-group">
                        <label class="control-label" for="basicinput">Subject Name</label>
                        <div class="controls">
                            <input type="text"  name="title" data-original-title="" class="span8 tip form-control">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Program</label>
                        <div class="controls">
                           <select class="span8 tip form-control" id="alumiProgrameId" name="programe_id">
                                <option value="">Select Program</option>
                                <?php
                                $q = $this->db->query("SELECT * FROM programes_info");
                               foreach($q->result() as $rec){
                               ?>
                                <option value="<?php echo $rec->programe_id;?>"><?php echo $rec->programe_name;?></option>
                               <?php 
                               }
                               ?>
                           </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Sub Program</label>
                        <div class="controls">
                           <select class="span8 tip form-control" id="showAlumiSubPro" name="sub_pro_id">
                               <option value="">Select Sub Program</option>
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