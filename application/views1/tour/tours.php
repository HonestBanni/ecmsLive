<div class="content container">
  <div class="page-wrapper">
    <div class="page-content">
      <div class="row">
        <article class="contact-form col-md-12 col-sm-7">                          
              <h2 align="left">Tours/Events  List<span  style="float:right"><a href="TourController/add_tour" class="btn btn-large btn-primary">Add Tours &amp; Events (T/E)</a></span><hr></h2>
            <?php
            if(@$tours):
            ?>
            <p>
            <button type="button" class="btn btn-success">
                <i class="fa fa-check-circle"></i>Total Records: <?php echo count(@$tours);?>
            </button>
            </p>
            <table class="table table-boxed table-hover">
              <thead>
                <tr>
                    <th>T/E Title</th>
                    <th>T/E Location</th>
                    <th>T/E Staff Incharge</th>
                    <th>T/E Date From</th>
                    <th>T/E Date To</th>
                    <th>T/E Total Days</th>
                    <th>View Students</th>
                    <th>Update Students</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                  foreach($tours as $row):
                    $sdate = $row->start_date;
                    $bdate = $row->back_date;
                    $stDate = date("d-m-Y", strtotime($sdate));
                    $bkDate = date("d-m-Y", strtotime($bdate));
                  
                  $date1 = new DateTime($bdate);
                  $date2 = new DateTime(date('Y-m-d'));
                  ?>
                <tr>
                    <td><?php echo $row->tour_title;?></td>
                    <td><?php echo $row->location;?></td>
                    <td><?php echo $row->emp_name;?></td>
                    <td><?php echo $stDate;?></td>
                    <td><?php echo $bkDate;?></td>
                    <td><?php echo $row->days;?></td>
            <td><a class="btn btn-primary btn-sm" href="TourController/view_students/<?php echo $row->tour_id;?>">View Students</a></td>
            <td>
            <?php 
                if($date2 > $date1): 
            ?>
                <a class="btn btn-warning disabled btn-sm" href="">Update Students</a>    
                <?php
                else:    
                ?>
                <a class="btn btn-warning btn-sm" href="TourController/update_students/<?php echo $row->tour_id;?>">Update Students</a>
                <?php
                    endif;
                ?>
                    </td>
                </tr>
                  <?php
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
          </article>
         
          </div>
        <!--//page-row-->
      </div>
      <!--//page-content-->
    </div>
    <!--//page-wrapper--> 
  </div>
