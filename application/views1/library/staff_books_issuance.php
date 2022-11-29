<div class="content container">
  <div class="page-wrapper">
    <div class="page-content">
      <div class="row">
        <article class="contact-form col-md-12 col-sm-7">                          
              <h2 align="left">Staff Books Issuance List<span  style="float:right"><a href="LibraryController/add_staff_book_issuance" class="btn btn-large btn-primary">Staff Books Issuance</a></span><hr></h2>
            <h4 style="color:red; text-align:center;">
                <?php print_r($this->session->flashdata('msg'));?>
            </h4>
            <form method="post">
            <div class="col-md-12">    
                <div class="form-group col-md-3">
                    <input type="text" name="emp_id" placeholder="Employee" class="form-control" id="em_name">
                    <input type="hidden" name="emp_id" id="emp_id">
                </div>
                  
                <div class="form-group col-md-3">
                   <input type="date" name="issuance_date" class="form-control">
                </div>
               <div class="form-group col-md-2">
                    <input type="submit" name="search" class="btn btn-theme" value="Search">
               </div>
            </div>
            </form>
            <?php
            if(@$books):
            ?>
            <p>
            <button type="button" class="btn btn-success">
                <i class="fa fa-check-circle"></i>Total Records: <?php echo count(@$books);?>
            </button>
            </p>
            
            <table class="table table-boxed table-hover">
              <thead>
                <tr>
                    <th>S#</th>
                    <th>Picture</th>
                    <th>Employee Name</th>
                    <th>Designation</th>
                    <th>Department</th>
                    <th>Job Type</th>
                    <th>Status</th>
                    <th>Add Remarks</th>
                    <th>View</th>
                    <th>Print</th>
                    <th>Return</th>
                    <th>Update</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                  $i=1;
                  foreach($books as $row):
                  $iss_id = $row->iss_id;
                  ?>
                <tr>
                    <td><?php echo $i;?></td>
        <td><img src="assets/images/employee/<?php echo $row->picture;?>" width="50" height="40"></td>
                    <td><?php echo $row->emp_name;?></td>
                    <td><?php echo $row->designation;?></td>
                    <td><?php echo $row->department;?></td>
                    <td><?php echo $row->contract;?></td>
                    <td><?php echo $row->employ_status;?></td>
                <?php 
                $where = array('lib_staff_book_issuance.emp_id'=>$row->emp_id);    
                $query = $this->LibraryModel->return_staffBooks_details('lib_staff_book_issuance',$where);
                    if($query):
                 ?>
                <td><a href="LibraryController/add_staff_comment/<?php echo $row->emp_id;?>">Add Remarks</a></td>     
                <td><a href="javascript:valid(0)" id="<?php echo $row->emp_id;?>" class="staff_books_details"><button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal">View</button></a></td>    
                <td><a class="btn btn-primary btn-sm" href="LibraryController/staff_books_issuance_print/<?php echo $row->emp_id;?>">Print</a></td>
                <td><a class="btn btn-danger btn-sm" href="LibraryController/update_staff_books_status/<?php echo $row->emp_id;?>">Return</a>
                </td>
                <td><a class="btn btn-theme btn-sm" href="LibraryController/update_staff_books/<?php echo $row->emp_id;?>">Update</a>
                </td>    
                     <?php
                    else:
                     ?>
        <td><a class="btn btn-success disabled btn-sm" href="#">Add Remarks</a></td>
        <td><a class="btn btn-success disabled btn-sm" href="#">View</a></td>
        <td><a class="btn btn-primary disabled btn-sm" href="#">Print</a></td>
        <td><a class="btn btn-danger disabled btn-sm" href="#">Return</a></td>
        <td><a class="btn btn-danger disabled btn-sm" href="#">Update</a></td>
                    <?php
                    endif;            
                    ?> 
                </tr>  
                  <?php
                  $i++;
                  endforeach;
                  ?>
              </tbody>
            </table>
            <?php
            else:
                echo '<strong style="color:red;font-size:18px;">Sorry ! Result not Found.. </strong>';
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
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel" align="center" style="color:Green">View Employee Books Details</h4>
      </div>
      <div class="modal-body">
          <div id="book_details_info">
              
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-theme" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>