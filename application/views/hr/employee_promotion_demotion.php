        <!-- ******CONTENT****** --> 
        <div class="content container">
               <!-- ******BANNER****** -->
            <h2 align="left">Employee Promotion/Demotion<hr></h2>
            <div class="row cols-wrapper">
                <div class="col-md-12"> 
                    <h4>
                        <span style="margin-right:30px;color:#208e4c"><?php echo $pages;?></span> 
                    </h4>
                    <form method="post" action="HrController/search_promotion_employee">
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
                 <input type="submit" name="search" value="Search" class="btn btn-theme">
                    </form>
                </div>
                <p>
            <button type="button" class="btn btn-success">
                <i class="fa fa-check-circle"></i>Total Records: <?php echo $count;?>
            </button>
            </p>
                    <table cellpadding="0" cellspacing="0" border="0" class="table table-boxed table-bordered table-striped	 display" width="100%">
                    <thead>
                        <tr>
                            <th>Picture</th>
                            <th>Emp-Name</th>
                            <th>F-Name</th>
                            <th>Promoted Designation</th>
                            <th>Promoted Scale</th>
                            <th>Old Designation</th>
                            <th>Old Scale</th>
                            <th>Contract Type</th>
                            <th>Category</th>
                            <th>Promotion Date</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
<?php
foreach($result as $rec)  
{  
  $picture = $rec->picture; 
  $date = $rec->promotion_date;
  $date1 = date('d-m-Y', strtotime($date));
  $old_desig_id = $rec->old_desig_id;
  $old_scale_id = $rec->old_scale_id;    
    ?>
                <tr class="gradeA">
                            <td><?php
                    if($picture == "")
                    {?>
        <img src="<?php echo base_url();?>assets/images/employee/user.png" width="60" height="40">
                    <?php
                    }else
                    {?>
    <img src="<?php echo base_url();?>assets/images/employee/<?php echo $rec->picture;?>" style="border-radius:10px;" width="60" height="40">
                <?php 
                    }
                    ?></td>
    <td><a href="<?php echo base_url();?>HrController/employee_profile/<?php echo $rec->emp_id;?>" style="text-transform:capitalize;"><?php echo $rec->emp_name;?></a>    
                    </td>
                    <td><?php echo $rec->father_name;?></td>
                    <td><?php echo $rec->cdesignation;?></td>
                    <td><?php echo $rec->scale;?></td>
                    <td><?php
$res = $this->HrModel->get_by_id('hr_emp_designation',array('emp_desg_id'=>$old_desig_id));
    if($res){
        foreach($res as $jrec){ ?>
            <?php echo $jrec->title;?>
     <?php 
        }     
    }else{
echo '';
        }    
    ?></td>
    <td><?php
$res = $this->HrModel->get_by_id('hr_emp_scale',array('emp_scale_id'=>$old_scale_id));
    if($res){
        foreach($res as $jrec){ ?>
            <?php echo $jrec->title;?>
     <?php 
        }     
    }else{
echo '';
        }    
    ?></td>
                    <td><?php echo $rec->contracttitle;?></td>
                    <td><?php echo $rec->categorytitle;?></td>
                    <td><?php echo $date1;?></td>
                    <td><?php echo $rec->remarks;?></td>
                </tr>
<?php
}
 ?>

                    </tbody>
                </table>
                </div><!--//col-md-3-->
                
            </div><!--//cols-wrapper-->
           