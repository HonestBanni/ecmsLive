<div class="content container">
  <div class="page-wrapper">
    <div class="page-content">
      <div class="row">
        <article class="contact-form col-md-12 col-sm-7">   

            <h4 style="color:red; text-align:center;">
            <?php print_r($this->session->flashdata('msg'));?>
                </h4>
            <p style="border-bottom:1px solid #ccc;"><strong style="font-size:18px;">Search a Student for Assigning Hostel</strong></p>
            <form method="post" action="HostelController/search_student">
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
                        <th>Program</th>
                        <th>Sub Program</th>
                        <th>Batch</th>
                        <th>Hostel Assign</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($student as $sRow):
                        
                        $check_flag = $this->db->get_where('hostel_student_record',array('student_id'=>$sRow->student_id))->row();
                    
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
                        <td><?php echo $sRow->program;?></td>
                        <td><?php echo $sRow->sub_program;?></td>
                        <td><?php echo $sRow->batch;?></td>
                        <td><?php
                            
                            if(@$check_flag->new_admission_flag ==1):
                                echo '<a class="btn btn-success btn-sm" href="HostelController/add_hostel_student/'.$sRow->student_id.'"><b>Add Hostel Student</b></a>';
                                else:
                                echo '<p>You have no entry in hostel merit list, Concern to IT manager</p>';
                            endif;
                            
                        ?>
                        
                    </td></tr>
                    <?php endforeach;?>
                </tbody>
            </table>
            <?php endif;?>
            <div class="form-group col-md-12">
            <p style="border-bottom:1px solid #ccc; margin-top:50px"><strong style="font-size:18px;">
                All Hostel Students List</strong></p>
            </div>
            <form method="post" action="HostelController/hostel_student_record">
                <div class="form-group col-md-2">
            <?php        
                
                if(!empty($student_id)){
                    $empres = $this->HostelModel->get_by_id('student_record',array('student_id'=>$student_id));
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
               <?php
                  echo form_dropdown('hostel_status_id', $status, $hostel_status_id, 'class="form-control"');
                   ?>
               </div> 
<div class="form-group col-md-2">
               <?php
                  echo form_dropdown('programe_id', $program, $programe_id, 'class="form-control" id="feeProgrameId"');
                   ?>
            </div>
            <div class="form-group col-md-2">
                <select name="batch_id" class="form-control" id="batch_id">
                <option value="">Select Batch</option>
                </select>
            </div>
            <div class="form-group  col-md-2">
                    <select name="sub_pro_id" class="form-control" id="showFeeSubPro">
                    <option value="">Sub Program</option>
                    </select>
            </div>
            <div class="form-group col-md-2">
               <?php
                  echo form_dropdown('h_batch_id', $hostel_batch, $h_batch_id, 'class="form-control"');
                   ?>
           </div>    
        <div class="form-group col-md-4">        
            <input type="submit" name="search" class="btn btn-theme" value="Search">
            <input type="submit" name="export" class="btn btn-theme" value="Export">
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
                <th>Image</th>
                <th width="80">Student</th>
                <th width="80">F-Name</th>
                <th width="50">Clg #</th>
                <th width="110">Batch</th>
                <th>S-Program</th>
                <th>Mobile #</th>
                <th>Alt-Date</th>
                <th>Lvd-Date</th>
                <th>Session</th>
                <th width="130">Reason</th>
                <th>Status</th>
                <th>Update</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $i = 1;
        foreach($result as $row):
  
            $dt = $row->allotted_date;
            $dt1 = $row->leaved_date;
            $date = date('d-m-Y', strtotime($dt));
            $date1 = date('d-m-Y', strtotime($dt1));
            $status = $row->hostel_status_id;
if($date1 === '0000-00-00'){
                    $date1 = '';
                    } else {
                    $date1 = date("d-m-Y", strtotime($date1 ));
                    }
        ?>    
            <tr>
            <td><?php echo $i;?></td>
            <td><img src="assets/images/students/<?php echo $row->applicant_image;?>" width="60" height="40"></td>
            <td><?php echo $row->student_name;?></td>
            <td><?php echo $row->father_name;?></td>
            <td><?php echo $row->college_no;?></td>
            <td><?php echo $row->batch;?></td>
            <td><?php echo $row->sub_program;?></td>
            <td><?php echo $row->student_mobile_no;?></td>
            <td><?php echo $date;?></td>     
            <td><?php
                if($status != 1):
                echo $date1;
                else:
                    echo '';
                endif;
                ?></td>
            <td><?php echo $row->h_batch_name;?></td>         
            <td><?php echo $row->reason;?></td>     
            <td>
            <?php
            if($status == 1):
                ?> 
                <span class="label label-success"><?php echo $row->status_name;?></span>
                <?php else: ?>
                <span class="label label-danger"><?php echo $row->status_name;?></span>
                <?php endif; ?>
                </td>   
                <td><a class="btn btn-theme btn-sm" href="HostelController/update_hostel_student/<?php echo $row->hostel_id;?>">Update</a> </td>   
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
