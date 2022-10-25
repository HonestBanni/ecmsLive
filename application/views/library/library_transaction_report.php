<div class="content container">
  <div class="page-wrapper">
    <div class="page-content">
      <div class="row">
        <article class="contact-form col-md-12 col-sm-7">                          
              <h2 align="left">Library Transaction Report<hr></h2>
            <h4 style="color:red; text-align:center;">
                <?php print_r($this->session->flashdata('msg'));?>
            </h4>
<form method="post">
        <div class="col-md-12">
        <div class="form-group col-md-2">
            <label>Accession #</label>
            <input type="text" name="accession_from" placeholder="New Acc. Number" class="form-control" id="accession_number">
        <input type="hidden" name="accession_from" id="accession_from">       
        </div>    
        <div class="form-group col-md-2">
            <label>From Issued Date</label>
            <input type="date" name="issued_date" value="<?php if(@$issued_date): echo $issued_date;endif; ?>" class="form-control">
        </div>
        <div class="form-group col-md-2">
            <label>To Issued Date</label>
            <input type="date" name="due_date" value="<?php if(@$due_date): echo $due_date;endif; ?>" class="form-control">
        </div>
        <div class="form-group col-md-2">
            <label>Status</label>
           <select class="form-control" name="availability_status_id">
               <option value="">Select Status</option>
                <?php 
                $st = $this->db->query("SELECT * FROM lib_book_availability_status");
                foreach($st->result() as $row):
                ?>
                <option value="<?php echo $row->availability_status_id;?>"><?php echo $row->title;?></option>
                <?php 
                endforeach;
                ?>
            </select>
        </div>    
        <div class="form-group col-md-2">
            <input style="margin-top:23px;" type="submit" name="search" value="Search" class="btn btn-theme">
            <input style="margin-top:23px;" type="submit" name="export" value="Export" class="btn btn-theme">
        </div>
        </div>    
    </form>
        
            <?php
            if(@$books):
            ?>
            <p>
            <button type="button" class="btn btn-success">
                <i class="fa fa-check-circle"></i>Total Records: <?php echo count($books); ?>
            </button>
            </p>
            <table class="table table-boxed table-hover">
              <thead>
                <tr>
                    <th>Serial No</th>
                    <th>New Accession#</th>
                    <th>Book Title</th>
                    <th>Book Status</th>
                    <th>Student Name (College #)</th>
                    <th>Issued Date</th>
                    <th>Due Date</th>
                    <th>Out Days</th>
                    <th>Fine</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                  $i=1;
                  foreach($books as $row):
                  $due_date = $row->due_date;
                  $date1 = new DateTime($due_date);
                  $date2 = new DateTime(date('Y-m-d'));
                  
                    $sts = $row->book_availablity_status_id;
                    if($sts == 5):
                  ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $row->accession_number;?></td>
                    <td><?php echo $row->book_title;?></td>
                    <td><?php echo $row->title;?></td>      
                    <td><?php echo $row->student_name;?> - <?php echo $row->college_no;?></td>
                    <td><?php echo $row->issued_date;?></td>      
                    <td><?php echo $row->due_date;?></td>    
                    <?php
                        $earlier = new DateTime($row->due_date);
                        $later = new DateTime(date("Y-m-d"));
                        $abs_diff = $later->diff($earlier)->format("%a"); //3die;
                        $fine = $abs_diff*5;
                    ?>
                    <td style="color:red"><?php echo $abs_diff." Days "; ?></td>
                    <td><?php echo "Rs.".$fine; ?> </td>
                </tr>  
                  <?php
                  else:
                  ?>
                  <tr style="color:green">
                    <td><?php echo $i;?></td>
                    <td><?php echo $row->accession_number;?></td>
                    <td><?php echo $row->book_title;?></td>
                    <td><?php echo $row->title;?></td>
                    <td><?php echo $row->student_name;?> (<?php echo $row->college_no;?>)</td>
                    <td><?php echo $row->issued_date;?></td>
                    <td><?php echo $row->due_date;?></td>
                   <?php
                        $earlier = new DateTime($row->due_date);
                        $later = new DateTime(date("Y-m-d"));
                        $abs_diff = $later->diff($earlier)->format("%a"); //3die;
                        $fine = $abs_diff*5;
                    ?>
                    <td style="color:red"><?php echo $abs_diff." Days "; ?></td>
                    <td><?php echo "Rs.".$fine; ?> </td> 
                </tr>  
                  <?php
                  endif;
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
          </article>
         
          </div>
        <!--//page-row-->
      </div>
      <!--//page-content-->
    </div>
    <!--//page-wrapper--> 
  </div>
 