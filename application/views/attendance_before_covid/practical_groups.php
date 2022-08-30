        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">Practical Groups List <span  style="float:right"><a href="AttendanceController/add_practical_group" class="btn btn-large btn-primary">Add Practical Group</a></span><hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12">
                   <form method="post">    
                     <div class="form-group col-md-3">
                        <input type="text" name="group_id" class="form-control" id="groupName">
                        <input type="hidden" name="group_id" id="group_id">
                    </div>
                    <div class="form-group col-md-3">
                       <select name="lab_id" class="form-control">
                            <option value="">Select Lab</option>
                            <?php
                                $pract = $this->db->query("SELECT * FROM labs");
                                foreach($pract->result() as $subs){
                            ?>
                            <option value="<?php echo $subs->lab_id;?>"><?php echo $subs->lab_name;?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>    
                    <div class="form-group col-md-3">
                       <select name="subject_id" class="form-control">
                            <option value="">Select Subject</option>
                            <?php
                                $pract = $this->db->query("SELECT * FROM practical_subject");
                                foreach($pract->result() as $subs){
                            ?>
                            <option value="<?php echo $subs->prac_subject_id?>"><?php echo $subs->title?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                            <button type="submit" name="search" value="search" id="search" class="btn btn-theme">
                            <i class="fa fa-search"></i> Search </button>
                     </div>
             </div>
                    </form> 
                    <table id='testing123' cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-boxed table-bordered table-striped	 display" width="100%">
                    <thead>
                        <tr>
                            <th>Serial No</th>
                            <th>Group Name</th>
                            <th>Lab Name</th>
                            <th>Subject</th>
                            
                            <th><i class="icon-edit" style="color:#fff"></i><b> Edit</b></th>
                            <th><i class="icon-trash" style="color:#fff"></i><b> Delete</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                    $i = 1;   
                    foreach($result as $rec)  
                    {
                        ?>
                        <tr class="gradeA">
                            <td><?php echo $i;?></td>
                            <td><?php echo $rec->group_name;?></td>
                            <td><?php echo $rec->lab_name;?></td>
                            <td><?php echo $rec->title;?></td>
                
    <td><a href="<?php echo base_url();?>AttendanceController/update_practical_group/<?php echo $rec->prac_group_id;?>" >
        <i class="icon-edit" style="color:#87a938"></i><b> Edit</b></a></td>
        <td><a href="<?php echo base_url();?>AttendanceController/delete_practical_group/<?php echo $rec->prac_group_id;?>" 
                                   onclick="return confirm('Are You Sure to Delete This..?')"><i class="icon-trash" style="color:#87a938"></i><b> Delete</b></a></td>
                        </tr>

                        <?php
                        $i++;
                        }
                        ?>


                    </tbody>
                </table>
                    
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
   