 <div class="content container">
  <div class="page-wrapper">
    <header class="page-heading clearfix">
      <h1 class="heading-title pull-left">Update Proctor
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
          <li class="current">Update Proctor
        </ul>
      </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
      <div class="row">
             <form method="post">
        <article class="contact-form col-md-12 col-sm-7"> 
         
          <div class="col-md-12" style="margin-bottom:10px;">
                 
          </div>
  
            <div class="row">
        <div class="col-md-12">
            <div class="form-group col-md-3">
                <label>Student Name</label>
        <input type="text" value="<?php echo $result->student_name;?>" class="form-control">
                   <input type="hidden" name="proctor_id" value="<?php echo $result->proctor_id;?>">  
                </div>
            <div class="form-group col-md-3">
                <label>College #</label>
        <input type="text" value="<?php echo $result->college_no;?>" class="form-control">  
                </div>
            <div class="form-group col-md-3">
                <label>Student Status</label>
            <select name="status" class="form-control">
                <option value="<?php echo $result->status;?>"><?php if($result->status == 1): echo "Active"; else: echo "Deactive"; endif;?></option>
                <option value="">Select Status</option>
                <option value="1">Active</option>
                <option value="2">Deactive</option>
            </select>    
                </div>
                <div class="form-group col-md-12">
                    <input type="submit" name="submit" value="Update Status" class="btn btn-theme">
                </div>         
        </div>
           </div>
                
            </article> 
            </form>
          <!--//contact-form-->
          </div>
        <!--//page-row-->
      </div>
      <!--//page-content-->
    </div>
    <!--//page-wrapper--> 
  </div>
  <!--//content-->
 
 