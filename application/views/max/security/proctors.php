<div class="content container">
  <div class="page-wrapper">
    <div class="page-content">
      <div class="row">
        <article class="contact-form col-md-12 col-sm-7">   
            
              <h2 align="left">Proctors  List<span  style="float:right"><a href="SecurityController/add_proctor" class="btn btn-large btn-primary">Add New Proctor</a></span><hr></h2>
            <h4 style="color:red; text-align:center;">
                <?php print_r($this->session->flashdata('msg'));?>
            </h4>
            <h4 style="color:green; text-align:center;">
                <?php print_r($this->session->flashdata('msg1'));?>
            </h4>
            <?php
            if(@$result):
            ?>
            <p>
            <button type="button" class="btn btn-success">
                <i class="fa fa-check-circle"></i>Total Records: <?php echo count(@$result);?>
            </button>
            </p>
            <table class="table table-boxed table-hover">
              <thead>
                <tr>
                    <th>S/No</th>
                    <th>Picture</th>
                    <th>Proctor Name</th>
                    <th>Father Name</th>
                    <th>College #</th>
                    <th>Password</th>
                    <th>Batch</th>
                    <th>Program</th>
                    <th>Sub Program</th>
                    <th>Section</th>
                    <th>Status</th>
                    <th>Update</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                  $i = 1;
                  foreach($result as $row):
                    $status = $row->status;
                  ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><img src="assets/images/students/<?php echo $row->applicant_image;?>" height="40" width="70"></td>
                    <td><?php echo $row->student_name;?></td>
                    <td><?php echo $row->father_name;?></td>
                    <td  style="color:red"><?php echo $row->college_no;?></td>
                    <td style="color:red"><?php echo $row->student_password;?></td>
                    <td><?php echo $row->batch_name;?></td>
                    <td><?php echo $row->program;?></td>
                    <td><?php echo $row->sub_program;?></td>
                    <td><?php echo $row->section;?></td>
                <td><?php if($status == 1): echo "<span class='badge badge-success'>Active</span>"; else: echo "<span class='badge badge-danger'>Deactive</span>"; endif;?></td>
                    <td><a href="SecurityController/update_proctor/<?php echo $row->proctor_id;?>" class="btn btn-theme">Update</a></td>
                </tr>
                  <?php
                  $i++;
                  endforeach;
                  ?>
              </tbody>
            </table>
            <?php
            else:
                echo "Records Not Found..";
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
