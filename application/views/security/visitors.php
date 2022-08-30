<div class="content container">
  <div class="page-wrapper">
    <div class="page-content">
      <div class="row">
        <article class="contact-form col-md-12 col-sm-7">   
            
              <h2 align="left">Visitors  List<span  style="float:right"><a href="SecurityController/add_visitor" class="btn btn-large btn-primary">Add New Visitor</a></span><hr></h2>
            <form method="post">
                <div class="col-md-12">
                <div class="form-group col-md-2">
                    <label>Visitor Name</label>
                   <input type="text" name="visitor_name" value="<?php if(@$visitor_name): echo $visitor_name;endif; ?>" placeholder="Visitor Name" class="form-control">
                </div>
                <div class="form-group col-md-2">
                    <label>Visiting Card#</label>
                   <input type="text" name="visiting_card_no" value="<?php if(@$visiting_card_no): echo $visiting_card_no;endif; ?>" placeholder="Visiting Card#" class="form-control">
                </div>
                <div class="form-group col-md-2">
                    <label>Visiting CNIC#</label>
                   <input type="text" name="cnic" value="<?php if(@$cnic): echo $cnic;endif; ?>" placeholder="Visiting CNIC#" class="form-control nic">
                </div>
                <div class="form-group col-md-2">
                    <label>From Date</label>
                   <input type="text" name="visiting_date" value="<?php if(@$visiting_date): echo date("d-m-Y", strtotime($visiting_date)); else: echo date('d-m-Y'); endif; ?>" class="form-control date_format_d_m_yy" required>
                </div>
                <div class="form-group col-md-2">
                 <label>To Date</label>
                   <input type="text" name="visiting_dateto" value="<?php if(@$visiting_dateto): echo date("d-m-Y", strtotime($visiting_dateto)); else: echo date('d-m-Y'); endif; ?>" class="form-control date_format_d_m_yy" required>
                </div>
<!--
                <div class="form-group col-md-2">
                    <label>Status</label>
                    <?php
//                    $statusArray = array(
//                    '1'=>'In',
//                    '2'=>'Out'
//                    );
//                echo form_dropdown('flag',$statusArray,$flag,  'class="form-control"');
                    ?>
-->
<!--
                    <label>Status</label>
                   <select class="form-control" name="status">
                        <option value="">Select Status</option> 
                        <option value="1">In</option> 
                        <option value="2">Out</option> 
                   </select>
-->
  <div class="form-group col-md-2">
    <input style="margin-top:23px;" type="submit" name="search" class="btn btn-theme" value="Search">
    <input style="margin-top:23px;" type="submit" name="export" class="btn btn-theme" value="Export">
  </div>
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
            <table class="table table-boxed table-hover">
              <thead>
                <tr>
                    <th>Visitor Card No</th>
                    <th>Visitor Name</th>
                    <th>Father Name</th>
                    <th>CNIC</th>
                    <th>Contact#</th>
                    <th>Meeting Person</th>
                    <th>Status</th>
                    <th>Update Students</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                  foreach($result as $row):
                      $flag  = $row->flag;
                  ?>
                <tr>
                    <td><?php echo $row->visiting_card_no;?></td>
                    <td><?php echo $row->visitor_name;?></td>
                    <td><?php echo $row->father_name;?></td>
                    <td><?php echo $row->cnic;?></td>
                    <td><?php echo $row->contact;?></td>
                    <td><?php echo $row->emp_name;?></td>
                    <td><?php 
                        if($flag == 1): 
                          echo "<span class='btn btn-warning btn-sm'>IN</span>"; 
                        else: 
                            echo "<span class='btn btn-theme btn-sm'>Out</span>"; 
                        endif;?></td>
                 
            <td><?php 
                if($flag == 1): 
                ?> 
        <a class="btn btn-danger btn-sm" href="SecurityController/update_visitor/<?php echo $row->serial_no;?>" onclick="return confirm('Are You Want to Change Status..?')">Update Status</a>
         <?php else: ?>
          <a class="btn btn-theme disabled btn-sm" href="#">Update Status</a>
            <?php
            endif;?>    
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
         
          </div>
        <!--//page-row-->
      </div>
      <!--//page-content-->
    </div>
    <!--//page-wrapper--> 
  </div>
