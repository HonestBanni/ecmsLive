<!-- ******CONTENT****** --> 
<div class="content container">
  <div class="page-wrapper">
      <div class="page-content">
      <div class="row">
     
            <div class="table-responsive">
                <h2 align="center">Tour/Event Update Students List<hr></h2>
        <article class="contact-form col-md-12 col-sm-12">
                <?php
                    $start_date = $tour->start_date;
                  $back_date = $tour->back_date;
            $startDate = date("d-m-Y", strtotime($start_date));
            $backDate = date("d-m-Y", strtotime($back_date));
                ?>
    <div style="width:100%; height:50px;">
        <div style="width:32%; height:45px; float:left">
            <strong>T/E Title: </strong> <?php echo $tour->tour_title;?></div>
        <div style="width:32%; height:45px;float:left">
            <strong>T/E Location: </strong> <?php echo $tour->location;?></div>
        <div style="width:32%; height:45px;float:right">
            <strong>Staff Incharge: </strong> <?php echo $tour->emp_name;?> (<?php echo $tour->title;?>)
        </div>
    </div>
    <div style="width:100%; height:50px;">
        <div style="width:32%; height:45px; float:left">
            <strong>T/E Date From: </strong> <?php echo $startDate;?>
        </div> 
        <div style="width:32%; height:45px; float:left">
            <strong>T/E Date To: </strong> <?php echo $backDate;?>
        </div>
        <div style="width:32%; height:45px; float:left">
            <strong>T/E Total Days: </strong> <?php echo $tour->tdays;;?>
        </div>       
    </div> 
          <h4 style="color:red; text-align:center;">
                <?php print_r($this->session->flashdata('msg'));?>
            </h4>
            <form method="post">
          <div class="col-md-12" style="margin-bottom:10px;">
                 <div class="form-group col-md-3">
        <input type="text" name="student_id" class="form-control" placeholder="Student Name" id="student_record">
                   <input type="hidden" name="student_id" id="student_id">
                   <input type="hidden" name="college_no" id="college_no">     
                   <input type="hidden" name="sub_pro_id" id="sub_pro_id">     
                </div>
                 <input type="hidden" name="tour_id" value="<?php echo $tour->tour_id;?>"> 
              <div class="form-group col-md-2">
            <input type="submit" name="add_student" value="Add Student" class="btn btn-theme">
                </div>
          </div>
        </form>   
            <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-boxed table-bordered table-striped	 display">
                <tr>
                    <td>Serial#</td>
                    <td>Student Picture</td>
                    <td>Student Name</td>
                    <td>Father Name</td>
                    <td>College #</td>
                    <td>Program</td>
                    <td>Sub Program</td>
                    <td>T/E Date From</td>
                    <td>T/E Date To</td>
                    <td>T/E Total Days</td>
                    <td>Delete</td>
                    <td>Update</td>
                </tr>
                <?php
              $i = 1;
               foreach($result as $urRow):
                    $datef = $urRow->datefrom;
                    $datet = $urRow->dateto;
                    $stDate = date("d-m-Y", strtotime($datef));
                    $bkDate = date("d-m-Y", strtotime($datet));
                ?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><img src="assets/images/students/<?php echo $urRow->applicant_image; ?>" width="50" height="30"></td>
                    <td><?php echo $urRow->student_name; ?></td>
                    <td><?php echo $urRow->father_name; ?></td>
                    <td><?php echo $urRow->college_no; ?></td>
                    <td><?php echo $urRow->programe_name; ?></td>
                    <td><?php echo $urRow->name; ?></td>
                    <td><?php echo $stDate;?></td>
                    <td><?php echo $bkDate;?></td>
                    <td><?php echo $urRow->tsdays;?></td>
                    <td><a class="btn btn-danger btn-sm" href="TourController/delete_students/<?php echo $urRow->serial_no;?>/<?php echo $urRow->tour_id;?>" onclick="return confirm('Are You Want to Delete..?')">Delete</a></td>
                    <td><a class="btn btn-theme btn-sm" href="TourController/update_student_date/<?php echo $urRow->serial_no;?>/<?php echo $urRow->tour_id;?>">Update</a></td>
                </tr>
    
                <?php
              $i++;
              endforeach;
            ?> 
            </table>
              
            </article>
            </div>
          </div>
        <!--//page-row-->
      </div>
      <!--//page-content-->
    </div>
    <!--//page-wrapper--> 
  </div>
  <!--//content-->
 
 