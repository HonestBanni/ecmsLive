        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">All Employees Record<hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12" style="min-height:650px;">
                    <h4>
                        <span style="margin-right:30px;color:#208e4c"><?php echo $pages;?></span> 
                        
                    </h4>              
                    <form method="post" action="HrController/search_add_employee_pic">
            <div class="form-group col-md-2">
                <input type="text" name="emp_name"  placeholder="Employee Name" class="form-control">      
            </div>                 
            <div class="form-group col-md-2">
                <input type="text" name="father_name" placeholder="Father Name" class="form-control">      
            </div>                 
            <div class="form-group col-md-2">
                <select class="form-control" name="gender_id">
                            <option value="">Select Gender</option>
                            <?php 
                            $g = $this->db->query("SELECT * FROM gender");
                            foreach($g->result() as $grec)
                            {
                            ?>
                                <option value="<?php echo $grec->gender_id?>"><?php echo $grec->title;?></option>
                            <?php
                            }
                            ?>
                        </select>     
            </div>                 
            <div class="form-group col-md-2">
                <select class="form-control" name="department_id">
                            <option value="">Select Department</option>
                            <?php 
                            $sb = $this->db->query("SELECT * FROM department");
                            foreach($sb->result() as $sbrec)
                            {
                            ?>
                                <option value="<?php echo $sbrec->department_id;?>"><?php echo $sbrec->title;?></option>
                            <?php
                            }
                            ?>
                        </select>      
            </div>                 
            <div class="form-group col-md-2">
                <select class="form-control" name="current_designation">
                            <option value="">Select Designation</option>
                            <?php 
                            $rs = $this->db->query("SELECT * FROM hr_emp_designation");
                            foreach($rs->result() as $rsrec)
                            {
                            ?>
                                <option value="<?php echo $rsrec->emp_desg_id;?>"><?php echo $rsrec->title;?></option>
                            <?php
                            }
                            ?>
                        </select>      
            </div>
            <div class="form-group col-md-2">
                <select class="form-control" name="c_emp_scale_id">
                            <option value="">Select Scale</option>
                            <?php 
                            $rs = $this->db->query("SELECT * FROM hr_emp_scale");
                            foreach($rs->result() as $rsrec)
                            {
                            ?>
                                <option value="<?php echo $rsrec->emp_scale_id;?>"><?php echo $rsrec->title;?></option>
                            <?php
                            }
                            ?>
                        </select>      
            </div>
            <div class="form-group col-md-2">
                <select class="form-control" name="cat_id">
                            <option value="">Category</option>
                            <?php 
                            $rs = $this->db->query("SELECT * FROM hr_emp_category");
                            foreach($rs->result() as $rsrec)
                            {
                            ?>
                                <option value="<?php echo $rsrec->cat_id;?>"><?php echo $rsrec->title;?></option>
                            <?php
                            } 
                            ?>
                        </select>      
            </div>
            <div class="form-group col-md-2">
                <select class="form-control" name="subject_id">
                            <option value="">Subject</option>
                            <?php 
                            $rs = $this->db->query("SELECT * FROM subject");
                            foreach($rs->result() as $rsrec)
                            {
                            ?>
                                <option value="<?php echo $rsrec->subject_id;?>"><?php echo $rsrec->title;?></option>
                            <?php
                            } 
                            ?>
                        </select>     
            </div> 
            <div class="form-group col-md-2">
                <select class="form-control" name="emp_status_id">
                            <option value="">Select Status</option>
                            <?php 
                            $g = $this->db->query("SELECT * FROM hr_emp_status");
                            foreach($g->result() as $grec)
                            {
                            ?>
            <option value="<?php echo $grec->emp_status_id?>"><?php echo $grec->title;?></option>
                            <?php
                            }
                            ?>
                        </select>     
            </div>            
                 <input type="submit" name="search" value="Search" class="btn btn-theme">
                    </form>
                   <div class="col-md-12">
                    <p>
            <button type="button" class="btn btn-success">
                <i class="fa fa-check-circle"></i>Total Records: <?php echo $count;?>
            </button>   
                    </p>
                    </div>
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-boxed table-bordered table-striped	 display" width="100%">
                    <thead>
                        <tr>
                            <th>Picture</th>
                            <th>Emp-Name</th>
                            <th>F-Name</th>
                            <th>Designation</th>
                            <th>Contract Type</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th><i class="icon-plus" style="color:#fff"></i><b> Add Pic</b></th>
                        </tr>
                    </thead>
                    <tbody>
<?php
foreach($result as $rec)  
{  
  $picture = $rec->picture;  
    ?>
                        <tr class="gradeA">
                            <td><?php
                    if($picture == "")
                    {?>
        <img src="<?php echo base_url();?>assets/images/employee/user.png" width="80" height="80">
                    <?php
                    }else
                    {?>
    <img src="<?php echo base_url();?>assets/images/employee/<?php echo $rec->picture;?>" style="border-radius:10px;" width="80" height="80">
                <?php 
                    }
                    ?></td>
                    <td><a href="http://172.16.0.111/ecms/HrController/employee_profile/<?php echo $rec->emp_id;?>" style="text-transform:capitalize;"><?php echo $rec->emp_name;?></a></td>
                    <td><?php echo $rec->father_name;?></td>
                    <td><?php echo $rec->cdesignation;?></td>
                    <td><?php echo $rec->contracttitle;?></td>
                    <td><?php echo $rec->categorytitle;?></td>
                    <td><?php echo $rec->title;?></td>
    <td><a class="btn btn-primary btn-sm" href="HrController/add_employee_pic/<?php echo $rec->emp_id;?>"><b>Add Pic</b></a></td>
                            
                        </tr>
<?php
}
 ?>

                    </tbody>
                </table>
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           
        </div><!--//content-->