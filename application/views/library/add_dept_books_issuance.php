 <div class="content container">
  <div class="page-wrapper">
    <header class="page-heading clearfix">
      <h1 class="heading-title pull-left">Book Issuance
      </h1>
      <div class="breadcrumbs pull-right">
        <ul class="breadcrumbs-list">
          <li class="breadcrumbs-label">You are here:
          </li>
          <li> 
            <?php echo anchor('admin/admin_home', 'Home');?> 
            <i class="fa fa-angle-right">
            </i>
          </li>
          <li class="current">Departmental Books Issuance
        </ul>
      </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
      <div class="row">
        <article class="contact-form col-md-12 col-sm-7">             
            <form method="post" action="LibraryController/insert_dept_books_issuance">
            <div class="row">
                <div class="col-md-12">
        <div class="form-group col-md-3">
        <lable>Employee Name(HOD): </lable>
        <input type="text" name="prepared_by" placeholder="Employee" class="form-control" id="emp_names">
        <input type="hidden" name="prepared_by" id="prepared_by">
                </div>            
        <div class="form-group col-md-3">
            <lable>Issuance Department </lable>
            <input type="text" name="department_id" placeholder="Department" class="form-control" id="dept">
        <input type="hidden" name="department_id" id="department_id">         
        </div>      
        <div class="form-group col-md-3">
            <lable>Issuance Date: <small>(MM-DD-YY)</small></lable>
            <input type="date" name="issuance_date" value="<?php echo date('Y-m-d');?>" class="form-control">
        </div>    
      </div>
    <div class="col-md-12">
                 <div class="form-group col-md-3">
        <input type="text" name="book_id" class="form-control" placeholder="Book Name" id="book_accession">
                   <input type="hidden" name="book_id" id="book_id" value="">
                   <input type="hidden" name="accession_no" id="accession_no" value="">
                </div>
                <div class="form-group col-md-2">
            <input type="button" name="submit" id="deptbooksissuance" value="Issue Book" class="btn btn-theme">
                </div>
                <div class="form-group col-md-12">
                    <input type="submit" name="submit_item" value="Submit" class="btn btn-theme">
                </div>
        <input type="hidden" name="form_Code" id="form_Code" value="<?php $rand = rand(1,10000000); $date = date('YmdHis');
                echo md5($rand.$date);

                ?>">            
                </div>
           </div>
                </form>
            </article>
          <article class="contact-form col-md-12 col-sm-7">
            <div id="booksIssuance">
              
            </div>
          </article>      
          <!--//contact-form-->
          </div>
        <!--//page-row-->
      </div>
      <!--//page-content-->
    </div>
    <!--//page-wrapper--> 
  </div>
  <!--//content-->
 
 