<div class="content container">
  <div class="page-wrapper">
    <div class="page-content">
      <div class="row">
        <article class="contact-form col-md-12 col-sm-7">   
              <h2 align="left">Vehicles List <span  style="float:right"><a href="AdminDeptController/add_vehicle" class="btn btn-large btn-primary">Add New Vehicle</a></span><hr></h2>
            <?php
            if(@$result):
            ?>
            <p>
            <button type="button" class="btn btn-success">
                <i class="fa fa-check-circle"></i>Total Records: <?php echo count(@$result);?>
            </button>
            <a href="AdminDeptController/print_vehicle">    
            <button type="button" class="btn btn-primary">
                <i class="fa fa-print"></i>Print
                </button></a>    
            </p>
    <table class="table table-boxed">
        <thead>
            <tr>
            <th>S/No</th>
            <th>Registration #</th>
            <th>Chassis #</th>
            <th>Model</th>
            <th>Color</th>
            <th>Engine #</th>
            <th>Make &amp; Maker</th>
            <th>Price</th>
            <th>Status</th>
            <th>Under Used</th>
            <th>Update</th>
        </tr>
        </thead>
        <tbody>
        <?php
            $i = 1;
        foreach($result as $row):
            $status_name = $row->status_name;
//            $dt = $row->issued_date;
//            $date = date('d-m-Y', strtotime($dt));
        ?>    
            <tr>
            <td><?php echo $i;?></td>
            <td><?php echo $row->registration_no;?></td>
            <td><?php echo $row->chassis_no;?></td>
            <td><?php echo $row->model;?></td>
            <td><?php echo $row->color;?></td>
            <td><?php echo $row->engine_no;?></td>
            <td><?php echo $row->make_and_maker;?></td>
            <td><?php echo $row->price;?></td> 
            
            <td><?php echo $status_name;?></td>   
            <td><?php echo $row->under_used;?></td> 
            <td><a href="AdminDeptController/update_vehicle/<?php echo $row->vehicle_id;?>" class="btn btn-primary">Update</a></td>    
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
