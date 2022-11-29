<div class="content container">
  <div class="page-wrapper">
    <div class="page-content">
      <div class="row">
        <article class="contact-form col-md-12 col-sm-7">   
            
              <h2 align="left">Daily Performance Report<hr></h2>
            <form method="post">
                <div class="col-md-12">
                    <div class="form-group col-md-2">
                         <label>Employee Name</label>
                   <?php
                      echo form_dropdown('emp_id', $emp, $emp_id, 'class="form-control"');
                       ?>
                   </div>    
                    <div class="form-group col-md-2">
                        <label>From Date</label>
                       <input type="text" name="from_date" value="<?php if(@$from_date): echo date("d-m-Y", strtotime($from_date)); else: echo date('d-m-Y'); endif; ?>" class="form-control date_format_d_m_yy" required>
                    </div>
                    <div class="form-group col-md-2">
                     <label>To Date</label>
                       <input type="text" name="to_date" value="<?php if(@$to_date): echo date("d-m-Y", strtotime($to_date)); else: echo date('d-m-Y'); endif; ?>" class="form-control date_format_d_m_yy" required>
                    </div>

                    <div class="form-group col-md-2">
                        <input style="margin-top:23px;" type="submit" name="search" class="btn btn-theme" value="Search">
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
                    <th>S/No</th>
                    <th>New Accession#</th>
                    <th>Old Accession#</th>
                    <th>Book Title</th>
                    <th>Author Name</th>
                    <th>Date and Time</th>
                    <th width="150">User Name</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                  $i = 1;
                  foreach($result as $row):
                  $date_time = $row->timestamp;
                  $newDate1 = date("d-m-Y H:i:s", strtotime($date_time));
                  ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $row->accession_number;?></td>
                    <td><?php echo $row->old_accession_number;?></td>
                    <td><?php echo $row->book_title;?></td>
                    <td><?php echo $row->author_name;?></td>
                    <td><?php echo $newDate1;?></td>
                    <td><?php echo $row->emp_name;?></td>
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
