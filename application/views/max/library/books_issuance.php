<div class="content container">
  <div class="page-wrapper">
    <div class="page-content">
      <div class="row">
        <article class="contact-form col-md-12 col-sm-7">                          
              <h2 align="left">Active Members List<span  style="float:right"><a href="LibraryController/add_book_issuance" class="btn btn-large btn-primary">Books Issuance</a></span><hr></h2>
            <h4 style="color:red; text-align:center;">
                <?php print_r($this->session->flashdata('msg'));?>
            </h4>
            
            
            <form method="post">
            <div class="col-md-12">    
                <div class="form-group col-md-2">
                    <label>Student</label>
    <input type="text" name="student_id" class="form-control" id="student_names">
        <input type="hidden" name="student_id" id="student_id">
                </div>
                <div class="form-group col-md-2">
                    <label>College No</label>
                   <input type="text" name="college_no" class="form-control">
                </div>
                <div class="form-group col-md-2">
                    <label>Issued Date</label>
                   <input type="date" name="issuance_date" class="form-control">
                </div>
                <div class="form-group col-md-2">
                    <label>Due Date</label>
                   <input type="date" name="due_date" class="form-control">
                </div>
               <div class="form-group col-md-2">
                    <input style="margin-top:23px;" type="submit" name="search" class="btn btn-theme" value="Search">
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
                    <th>Student Name</th>
                    <th>Father Name</th>
                    <th>College#</th>
                    <th>View Books Details</th>
                    <th>Print Card</th>
                    <th>Print Books</th>
                    <th>Return Book</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                  $i=1;
                  foreach($books as $row):
                  $issuance_id = $row->issuance_id;
                  ?>
                <tr>
                    <td><?php echo $i;?></td>
        <td><img src="assets/images/students/<?php echo $row->applicant_image;?>" width="60" height="50"></td>
                    <td><?php echo $row->student_name;?></td>
                    <td><?php echo $row->father_name;?></td>
                    <td><?php echo $row->college_no;?></td>
                <?php 
                $where = array('lib_book_issuance.student_id'=>$row->student_id);    
                $query = $this->LibraryModel->return_Books_details('lib_book_issuance',$where);
                    if($query):
                 ?>    
                <td><a href="javascript:valid(0)" id="<?php echo $row->student_id;?>" class="books_details"><button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal"> View Books Details </button></a></td>    
                <td><a class="btn btn-primary btn-sm" href="LibraryController/print_book_card/<?php echo $row->student_id;?>">Print Card</a></td>
                <td><a class="btn btn-primary btn-sm" href="LibraryController/books_issuance_print/<?php echo $row->student_id;?>">Print Books</a></td>
                <td><a class="btn btn-danger btn-sm" href="LibraryController/update_book_issu_status/<?php echo $row->student_id;?>">Book Return</a>
                </td>
                     <?php
                    else:
                     ?>
        <td><a class="btn btn-success disabled btn-sm" href="#">View Book Details</a></td>
        <td><a class="btn btn-primary disabled btn-sm" href="#">Print Card</a></td>
        <td><a class="btn btn-primary disabled btn-sm" href="#">Print Books</a></td>
        <td><a class="btn btn-danger disabled btn-sm" href="#">Book Return</a></td>
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
        <h4 class="modal-title" id="myModalLabel" align="center" style="color:Green">View Books Details</h4>
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