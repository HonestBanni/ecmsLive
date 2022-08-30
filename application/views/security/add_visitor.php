 <div class="content container">
  <div class="page-wrapper">
    <header class="page-heading clearfix">
      <h1 class="heading-title pull-left">Add Visitor
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
          <li class="current">Add Visitor
        </ul>
      </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
      <div class="row">
        <article class="contact-form col-md-12 col-sm-7">             
            <form name="postitem" method="post" action="SecurityController/add_visitor">
            <div class="row">
        <div class="col-md-12">
            <div class="form-group col-md-3">
                <lable>Visitor Name: </lable>
                <input type="text" name="visitor_name" placeholder="Visitor Name" class="form-control">
            </div>
            <div class="form-group col-md-3">
                <lable>Father Name: </lable>
                <input type="text" name="father_name" placeholder="Father Name" class="form-control">
            </div>
            <div class="form-group col-md-3">
                <lable>CNIC : </lable>
                <input type="text" name="cnic" placeholder="CNIC" class="form-control nic">
            </div>
            <div class="form-group col-md-3">
                <lable>Contact # : </lable>
                <input type="text" name="contact" placeholder="Phone" class="form-control">
            </div>
            <div class="form-group col-md-6">
                <lable>Address : </lable>
                <input type="text" name="address" placeholder="Address" class="form-control">
            </div>
            <div class="form-group col-md-3">
                <lable>Meeting Person: </lable>
        <input type="text" name="emp_id" id="emp_record" placeholder="Meeting Person" class="form-control">
                <input type="hidden" name="emp_id" id="emp_id">
            </div>
            <div class="form-group col-md-3">
                <lable>Care of Student: </lable>
        <input type="text" name="student_id" placeholder="Care of Student" class="form-control" id="std_names" required>
        <input type="hidden" name="student_id" id="student_id">
            </div>
            <div class="form-group col-md-3">
                <lable>Relation: </lable>
        <input type="text" name="relation_id" placeholder="Relation" class="form-control" id="relation" required>
        <input type="hidden" name="relation_id" id="relation_id">
            </div>
            <div class="form-group col-md-3">
                <lable>Purpose of Meeting: </lable>
        <input type="text" name="purpose_of_meeting" placeholder="Purpose of Meeting" class="form-control">
            </div>
            <div class="form-group col-md-3">
                <lable>Collected Document: </lable>
                <select type="text" name="collected_document" class="form-control">
                        <option value="cnic">CNIC</option>
                        <option value="driver_license">Driver License</option>
                        <option value="student_card">Student Card</option>
                        <option value="service_card">Service Card</option>
                </select>
            </div>
            <div class="form-group col-md-3">
                <lable>Visiting Card No: </lable>
        <input type="text" name="visiting_card_no" placeholder="Visiting Card No" class="form-control">
            </div>
            <div class="form-group col-md-3">
                <lable>Remarks: </lable>
        <input type="text" name="remarks" placeholder="Remarks" class="form-control">
            </div>  
            <div class="form-group col-md-4">
                <input type="submit" name="submit" value="Submit" class="btn btn-theme">
            </div>              
        </div>
           </div>
                </form>
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
 
 