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
          <li class="current">Book Issuance
        </ul>
      </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
      <div class="row">
        <article class="contact-form col-md-12 col-sm-7">             
            <form name="postitem" method="post" action="LibraryController/insert_books_issuance">
            <div class="row">
                <div class="col-md-12">
                <div class="form-group col-md-3">
                    <lable>Student Name: </lable>
        <input type="text" name="student_id" placeholder="Student Name" class="form-control" id="student_names">
        <input type="hidden" name="student_id" id="student_id">
        <input type="hidden" name="college_no" id="college_no">
                </div> 
                <div class="form-group col-md-3">
                    <lable>Issuance Date: <small>(MM-DD-YY)</small></lable>
                    <input type="date" name="issuance_date" id="issuance_date_student" value="<?php echo date('Y-m-d');?>" class="form-control">
                </div>
            <div class="form-group col-md-3">
            <lable>Due Date: <small>(MM-DD-YY)</small></lable>
            <?php
                $due_date   = date('Y-m-d', strtotime('+ 15 days'));
            ?>
            <input type="date" name="due_date" id="due_date_student" value="<?php echo $due_date;?>" class="form-control" readonly="readonly">
        </div>      
                </div>
                <div class="col-md-12">
                 <div class="form-group col-md-3">
        <input type="text" name="book_id" class="form-control" placeholder="Book Name" id="book_accession">
                   <input type="hidden" name="book_id" id="book_id" value="">
                   <input type="hidden" name="accession_no" id="accession_no" value="">
                </div>
                <div class="form-group col-md-2">
            <input type="button" name="submit" id="addbooksissuance" value="Add Book" class="btn btn-theme">
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
 
  <script>
      $(document).ready(function(){    
        $('#issuance_date_student').on('change', function(){
            $.ajax({
                 type    : 'post',
                 url     : 'LibraryController/get_due_date',
                 data    : { 'issue_date' : $(this).val() },
                 success : function(result){
                     console.log(result);
                     $('#due_date_student').val(result);
                 }
             });
        });
      });
  </script>