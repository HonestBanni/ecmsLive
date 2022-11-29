 <div class="content container">
  <div class="page-wrapper">
    <header class="page-heading clearfix">
      <h1 class="heading-title pull-left">Add Tour/Event (T/E)
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
          <li class="current">Add Tour/Event
        </ul>
      </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
      <div class="row">
        <article class="contact-form col-md-12 col-sm-7">             
            <form name="postitem" method="post">
            <div class="row">
        <div class="col-md-12">
            <div class="form-group col-md-3">
                <lable>T/E Title: </lable>
                <input type="text" name="tour_title" placeholder="Tour Title" class="form-control">
            </div>
            <div class="form-group col-md-3">
                <lable>T/E Location: </lable>
                <input type="text" name="location" placeholder="Location" class="form-control">
            </div> 
            <div class="form-group col-md-3">
                <lable>T/E Staff Incharge: </lable>
            <input type="text" name="emp_id" id="emp_record" placeholder="Tour Leader" class="form-control">
                <input type="hidden" name="emp_id" id="emp_id">
                <input type="hidden" name="current_designation" id="current_designation">
            </div>
            <div class="form-group col-md-3">
                <lable>T/E Date From: <small>(MM-DD-YY)</small></lable>
                <input type="text" name="start_date" value="<?php echo date('d-m-Y');?>" class="form-control date_format_d_m_yy">
            </div>
            <div class="form-group col-md-3">
                <lable>T/E Date To: <small>(MM-DD-YY)</small></lable>
                <input type="text" name="back_date" value="<?php echo date('d-m-Y');?>" class="form-control date_format_d_m_yy">
            </div>              
        </div>
        <div class="col-md-12">
                 <div class="form-group col-md-3">
        <input type="text" name="student_id" class="form-control" placeholder="Student Name" id="student_record">
                   <input type="hidden" name="student_id" id="student_id">
                   <input type="hidden" name="college_no" id="college_no">     
                   <input type="hidden" name="sub_pro_id" id="sub_pro_id">     
                </div>
                <div class="form-group col-md-2">
            <input type="button" name="submit" id="addstudent" value="Add Student" class="btn btn-theme">
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
 
 