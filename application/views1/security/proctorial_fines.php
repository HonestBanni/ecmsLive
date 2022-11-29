<div class="content container">
  <div class="page-wrapper">
    <div class="page-content">
      <div class="row">
        <article class="contact-form col-md-12 col-sm-7">   
              <h2 align="left">Chief Proctor Fines List <span  style="float:right"><a href="SecurityController/add_student_fine" class="btn btn-large btn-primary">Add Student Fine</a></span><hr></h2>
            <form method="post">
                <div class="col-md-12">
                <div class="form-group col-md-2">
        <input type="text" name="college_no" class="form-control" placeholder="College #"> 
                </div>   
               <div class="form-group col-md-2">
        <input type="text" name="student_id" class="form-control" placeholder="Student Name" id="student_record">
                   <input type="hidden" name="student_id" id="student_id">  
                </div>
                <div class="form-group col-md-2">
        <input type="text" name="proctor_id" class="form-control" placeholder="Proctor Name" id="proctor_record">
            <input type="hidden" name="proctor_id" id="proctor_id">
                </div>
            <input type="submit" name="search" class="btn btn-theme" value="Search">

                </div>    
            </form>
            <?php
            if(@$result):
            ?>
            <p>
            <button type="button" class="btn btn-success">
                <i class="fa fa-check-circle"></i>Total Records: <?php echo count(@$result);?>
            </button>
            </p>
    <table class="table table-boxed">
        <thead>
            <tr>
            <th>S/No</th>
            <th>Student Picture</th>
            <th>Student Name</th>
            <th>Father Name</th>
            <th>College #</th>
            <th>Sub Program</th>
            <th>Fine Date</th>
            <th>Amount</th>
            <th>Proctor Name</th>
            <th>Status</th>
            <th>View Details</th>
            <th>Update</th>
        </tr>
        </thead>
        <tbody>
        <?php
            $i = 1;
        foreach($result as $row):
            $proctor_id = $row->proctor_id;
            $status = $row->status_name;
  
            $dt = $row->date;
            $date = date('d-m-Y', strtotime($dt));
        ?>    
            <tr>
            <td><?php echo $i;?></td>
            <td><img src="assets/images/students/<?php echo $row->applicant_image;?>" width="60" height="40"></td>
            <td><?php echo $row->student_name;?></td>
            <td><?php echo $row->father_name;?></td>
            <td><?php echo $row->college_no;?></td>
            <td><?php echo $row->sub_program;?></td>
            <td><?php echo $date;?></td>
            <td><?php echo $row->amount;?></td>
            <td><?php
            $gres = $this->SecurityModel->get_by_proc_id('proctors',array('proctor_id'=>$proctor_id));
                if($gres):
                foreach($gres as $grec); ?> 
               <?php echo $grec->student_name;?> 
                 <?php 
                endif; ?>
                </td>
                <td><?php if($status == 3): echo "<span class='badge badge-success'>".$status."<span>"; else: echo "<span class='badge badge-danger'>".$status."<span>"; endif;?></td>
            <td><a href="SecurityController/view_proctorial_fine/<?php echo $row->proc_id;?>" class="btn btn-theme">View</a></td>    
            <td><a href="SecurityController/update_proctorial_fine/<?php echo $row->proc_id;?>" class="btn btn-primary">Update</a></td>    
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
