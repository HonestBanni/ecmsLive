        <!-- ******CONTENT****** --> 
        <div class="content container" style="margin-bottom:200px;">
               <!-- ******BANNER****** -->
    <h2 align="left">All Groups Data <hr></h2>        
            <div class="row cols-wrapper">
                <div class="row cols-wrapper">
                    <form>
                        <?php
                    $q = $this->db->query("SELECT DISTINCT sections.name as section,sections.sec_id as sec_id from sections,student_group_allotment where student_group_allotment.section_id = sections.sec_id order by sections.name asc");
                            foreach($q->result() as $row)
                            {
                                $section_id = $row->sec_id;
                            $s = $this->db->query("SELECT  `student_record`.`student_name` FROM `student_record`,`student_group_allotment` WHERE `student_group_allotment`.student_id = student_record.student_id AND `section_id`='$section_id'");    
                            ?>
                        <div style="float:left" class="form-group col-md-2">
                            <label for="usr"></label>
     <input value="<?php echo $row->section;?> (Total: <?php echo $s->num_rows();?>)" class="form-control" readonly> 
                        </div> 
                         <?php } ?>
                    </form>
                </div>
                <div class="col-md-12">
                     <h4>
                        <span style="margin-left:120px; color:#208e4c">Total Records: <?php echo count($result);?></span>
                    </h4>
                    <form method="post" action="admin/search_by_group_student">
                        <div class="form-group col-md-2">
                            <?php 
                                echo form_dropdown('sec_id',$sections,$sec_id,  'class="form-control"');
                            ?>    
                        </div>
                        <div class="form-group col-md-2">
    <input type="text" name="student_name" class="form-control"  value="<?php if($student_name): echo $student_name;endif; ?>" >    
                        </div>
                        <div class="form-group col-md-2">
    <input type="text" name="father_name" class="form-control" value="<?php if($father_name): echo $father_name;endif; ?>">    
                        </div>
                        <div class="form-group col-md-2">
    <input type="text" name="college_no" class="form-control" value="<?php if($college_no): echo $college_no;endif; ?>">    
                        </div>
                        <input type="submit" name="search" class="btn btn-theme" value="Search">
                        <input type="submit" name="export" class="btn btn-theme" value="Export">
                    </form>
                    <table  border="0" class=" table table-boxed table-bordered table-striped display" width="100%">
                    <thead>
                        <tr>
                            <th>Student Image</th>
                            <th>Student Name</th>
                            <th>Father Name</th>
                            <th>College No.</th>
                            <th>Section Name</th>
                            <th>Gender</th>
                            <th>Program</th>
                            <th><i class="icon-edit" style="color:#fff;"></i> Update</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php
                if($result):        
                foreach($result as $rec)  
                {
                    
                ?>
                        <tr class="gradeA">
                             <td><img src="assets/images/students/<?php echo $rec->applicant_image;?>" width="60" height="50"></td>
                             <td><?php echo $rec->student;?></td>
                             <td><?php echo $rec->father;?></td>
                             <td><?php echo $rec->college_no;?></td>
                            <td><?php echo $rec->section;?></td>
                            <td><?php echo $rec->gender;?></td>
                            <td><?php echo $rec->sub_program;?></td>
                            <td><a href="<?php echo base_url();?>admin/update_student_by_group/<?php echo $rec->serial_no;?>" class="btn btn-success btn-sm">Update</a></td>
                        </tr>

                    <?php
                    }
                    ?>
                    </tbody>
                </table>
                   
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
   <?php 
else:  
    ?>
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
                        <label class="control-label" for="basicinput">Sub Program</label>
                        <div class="controls">
                            <select name="sub_pro_id" class="form-control span8 tip" required>
                                <option>&larr; Sub Programe &rarr;</option>
                        <?php
                $p = $this->db->query("SELECT * FROM sub_programes");
                foreach($p->result() as $pr)
                        {        
                        ?>        
                                <option value="<?php echo $pr->sub_pro_id;?>"><?php echo $pr->name;?></option>
                        <?php
                            }
                            ?>    
                            </select>
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
                                <option value="on">On</option>
                                <option value="off">Off</option>
                            </select>              
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Batch Name</label>
                        <div class="controls">
     <select name="batch_id" class="form-control span8 tip" required>
                                <option>&larr; Batch Name &rarr;</option>
                        <?php
                $p = $this->db->query("SELECT * FROM prospectus_batch");
                foreach($p->result() as $pr)
                        {        
                        ?>        
                                <option value="<?php echo $pr->batch_id;?>"><?php echo $pr->batch_name;?></option>
                        <?php
                            }
                            ?>    
                            </select>             
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="basicinput">Program Name</label>
                        <div class="controls">
     <select name="program_id" class="form-control span8 tip" required>
                                <option>&larr; Program Name &rarr;</option>
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
<?php endif;?>