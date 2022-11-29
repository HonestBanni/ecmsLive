        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">Year Head Practical Report <hr></h2>
            
            <div class="row cols-wrapper">
                <div class="col-md-12">
                    <div class="col-md-12">
                <form method="post">    
                    <div class="form-group col-md-3">
            <?php 
             echo form_dropdown('prac_subject_id', $subject,$prac_subject_id,'class="form-control"');
             ?>
                    </div>
                    <div class="form-group col-md-3">
                       <?php 
             echo form_dropdown('gender_id', $gender,$gender_id,'class="form-control"');
             ?>
                    </div>
                    <div class="form-group col-md-2">
                        <?php
                        if(@$group){
                        ?>
            <input type="text" name="group_id" value="<?php echo $group->group_name; ?>" class="form-control" id="groupName">
            <input type="hidden" name="group_id" id="group_id" value="<?php echo $group->prac_group_id; ?>">      
                        <?php 
                        } else{?>
           <input type="text" name="group_id" class="form-control" placeholder="Select Group" id="groupName">
                <input type="hidden" name="group_id" id="group_id">  
                        <?php
                        }    
                    ?>                  
                    </div>
                    <div class="form-group col-md-1">
                            <button type="submit" name="search" value="search" id="search" class="btn btn-theme">
                            <i class="fa fa-search"></i> Search </button>
                     </div>
                    <div class="form-group col-md-1">
                            <button type="submit" name="export" value="Export" class="btn btn-theme">export</button>
                     </div>
             </div>
                    </form>  
                    <?php
                        if(@$result):
                    ?>
                    <h4>Total Record: <?php echo count($result);?></h4>
                    <table id='testing123' cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-boxed table-bordered table-striped	 display" width="100%">
                    <thead>
                        <tr>
                            <th>Serial No</th>
                            <th>Section Name</th>
                            <th>College No</th>
                            <th>Student Name</th>
                            <th>Group Name</th>
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
                            <td><?php echo $rec->name;?></td>
                            <td><?php echo $rec->college_no;?></td>
                            <td><?php echo $rec->student_name;?></td>
                            <td><?php echo $rec->group_name;?></td>
               
                        </tr>

                        <?php
                        $i++;
                        }
                        ?>
                    </tbody>
                </table>
                    <?php
                    else:
                        echo "";
                    endif;
                    ?>
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->
   