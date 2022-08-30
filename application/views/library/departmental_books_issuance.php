<div class="content container">
  <div class="page-wrapper">
    <div class="page-content">
      <div class="row">
        <article class="contact-form col-md-12 col-sm-7">                          
              <h2 align="left">Departmental Books Issued List<span  style="float:right"><a href="LibraryController/add_dept_books_issuance" class="btn btn-large btn-primary">Departmental Books Issuance</a></span><hr></h2>
            <h4 style="color:red; text-align:center;">
                <?php print_r($this->session->flashdata('msg'));?>
            </h4>
            <form method="post">
            <div class="col-md-12"> 
                <div class="form-group col-md-2">
            <input type="text" name="department_id" placeholder="Department" class="form-control" id="dept">
        <input type="hidden" name="department_id" id="department_id">         
        </div>
                <div class="form-group col-md-2">
        <input type="text" name="prepared_by" placeholder="Employee" class="form-control" id="emp_names">
        <input type="hidden" name="prepared_by" id="prepared_by">
                </div>
                <div class="form-group col-md-2">
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
                    <th>Employee (HOD)</th>
                    <th>Department</th>
                    <th>View</th>
                    <th>Print</th>
                </tr>
              </thead>
              <tbody>
                  <?php
                  $i=1;
                  foreach($books as $row):
                  $iss_id = $row->dept_iss_id;
                  ?>
                <tr>
                    <td><?php echo $i;?></td>
                    <td><?php echo $row->emp_name;?></td>
                    <td><?php echo $row->department;?></td>
                    <td><a href="javascript:valid(0)" id="<?php echo $row->dept_id;?>" class="dept_books_details"><button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#myModal">View</button></a></td>    
                    <td><a class="btn btn-primary btn-sm" href="LibraryController/dept_books_issuance_print/<?php echo $row->dept_id;?>">Print</a></td>    
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
        <h4 class="modal-title" id="myModalLabel" align="center" style="color:Green">Deparmental Books Details</h4>
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