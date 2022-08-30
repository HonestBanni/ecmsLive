<div class="content container">
  <div class="page-wrapper">
    <div class="page-content">
      <div class="row">
        <article class="contact-form col-md-12 col-sm-7">
            <h4 style="color:red; text-align:center;">
            <?php print_r($this->session->flashdata('msg'));?>
                </h4>
            <p style="border-bottom:1px solid #ccc;"><strong style="font-size:18px;">Search a Student to Migrate</strong></p>
            <form method="post" action="admin/search_degree_migrated_student">
                  <div class="form-group col-md-2">
                        <input type="text" name="college_no"  placeholder="College No." class="form-control">
                  </div>
                  <div class="form-group col-md-2">
                        <input type="text" name="form_no" placeholder="Form No." class="form-control">
                  </div>
                  <div class="form-group col-md-2">
                        <input type="text" name="student_name" placeholder="Student Name" class="form-control">
                  </div>
                  <div class="form-group col-md-2">
                        <input type="text" name="father_name" placeholder="Father Name" class="form-control">
                  </div>
                <div class="form-group col-md-2">
                 <input type="submit" name="submit" class="btn btn-theme" value="Search">
                </div>
            </form>
            <?php if(@$student):?>
            <table class="table table-boxed table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Picture</th>
                        <th>Student</th>
                        <th>F-Name</th>
                        <th>Form #</th>
                        <th>College #</th>
                        <th>Sub Program</th>
                        <th>Batch</th>
                        <th>Student Migration</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($student as $sRow):
                    ?>
                <tr>
                        <td><?php
                    if($sRow->applicant_image == "")
                    {?>
        <img src="<?php echo base_url();?>assets/images/students/user.png" width="60" height="60">
                    <?php
                    }else
                    {?>
    <img src="<?php echo base_url();?>assets/images/students/<?php echo $sRow->applicant_image;?>" style="border-radius:10px;" width="60" height="60">
                <?php 
                    }
                    ?></td>
                        <td><?php echo $sRow->student_name;?></td>
                        <td><?php echo $sRow->father_name;?></td>
                        <td><?php echo $sRow->form_no;?></td>
                        <td><?php echo $sRow->college_no;?></td>
                        <td><?php echo $sRow->sub_program;?></td>
                        <td><?php echo $sRow->batch;?></td>
                        <td><a class="btn btn-success btn-sm" href="admin/add_degree_migrated_student/<?php echo $sRow->student_id;?>"><b>Student Migration </b></a></td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
            <?php endif;?>
            <div class="form-group col-md-12">
            <p style="border-bottom:1px solid #ccc; margin-top:50px"><strong style="font-size:18px;">
                Migrated Students List</strong></p>
            </div>
            <form method="post" action="admin/degree_migrated_student_record">
                <div class="form-group col-md-2">
            <?php        
                
                if(!empty($student_id)){
                    $empres = $this->get_model->get_by_id('student_record',array('student_id'=>$student_id));
                    foreach($empres as $emprec)
                    { ?>          
        <input type="text" name="student_id" value="<?php echo $emprec->student_name; ?>" placeholder="Student Name" class="form-control" id="std_namess">
                    <input type="hidden" name="student_id" id="student_id" value="<?php echo $emprec->student_id; ?>">      
                    <?php 
                    }     
                }else{?>
        <input type="text" name="student_id" class="form-control" placeholder="Student Name" id="std_namess">
        <input type="hidden" name="student_id" id="student_id">
                    <?php
                    }    
                ?>                  
            </div>       
        <div class="form-group col-md-2">        
            <input type="submit" name="search" class="btn btn-theme" value="Search">
        </div>        
            </form>
            <?php
            if(@$result):
            ?>
            <div class="form-group col-md-12">
            <p>
            <button type="button" class="btn btn-success">
                <i class="fa fa-check-circle"></i>Total Records: <?php echo count(@$result);?>
            </button>
            </p>
            </div>    
    <table class="table table-boxed">
        <thead>
            <tr>
                <th>S/No</th>
                <th>Student Image</th>
                <th>Student Name</th>
                <th>Father Name</th>
                <th>College #</th>
                <th>Migrated Institute</th>
                <th>Migrated Board</th>
                <th>Migrated Date</th>
                <th>Status</th>
                <th>Update</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $i = 1;
        foreach($result as $row):
  
            $dt = $row->migration_date;
            $date = date('d-m-Y', strtotime($dt));
            $status = $row->s_status_id;
        ?>    
            <tr>
            <td><?php echo $i;?></td>
            <td><img src="assets/images/students/<?php echo $row->applicant_image;?>" width="60" height="40"></td>
            <td><?php echo $row->student_name;?></td>
            <td><?php echo $row->father_name;?></td>
            <td><?php echo $row->college_no;?></td>
            <td><?php echo $row->migrated_institute;?></td>         
            <td><?php echo $row->title;?></td>         
            <td><?php echo $date;?></td>         
            <td>
            <?php
            if($status == 1):
                ?> 
                <span class="label label-success"><?php echo $row->name;?></span>
                <?php else: ?>
                <span class="label label-danger"><?php echo $row->name;?></span>
                <?php endif; ?>
                </td>   
                <td><a class="btn btn-theme btn-sm" href="admin/update_degree_migrated_student/<?php echo $row->migration_id;?>">Update</a> </td>   
        </tr>
            <?php 
            $i++;
                endforeach;
            ?>
        </tbody>
    </table>
            <?php
            else:
                echo "";
            endif;
                ?>
</article>
         
          </div>
        <!--//page-row-->
      </div>
      <!--//page-content-->
    </div>
    <!--//page-wrapper--> 
  </div>
