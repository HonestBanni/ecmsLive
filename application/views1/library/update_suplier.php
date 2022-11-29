<div class="content container">
  <div class="page-wrapper">
    <header class="page-heading clearfix">
      <h1 class="heading-title pull-left">Update Suplier
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
          <li class="current">Update Suplier
        </ul>
      </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
      <div class="row">
        <article class="contact-form col-md-12 col-sm-7">             
            <form name="postitem" method="post" action="LibraryController/update_suplier/<?php echo $result->sup_id;?>">
            <div class="row">
                <div class="col-md-12">
        <div class="form-group col-md-4">
            <lable>Suplier Name</lable>
           <input type="text" name="sup_name" value="<?php echo $result->sup_name;?>" class="form-control">
        <input type="hidden" name="sup_id" value="<?php echo $result->sup_id;?>">
        </div>
        <div class="form-group col-md-4">
            <lable>Phone</lable>
           <input type="text" name="phone" value="<?php echo $result->phone;?>" class="form-control phone">
        </div>
        <div class="form-group col-md-4">
            <lable>Email</lable>
    <input type="text" name="email" value="<?php echo $result->email;?>" class="form-control">
        </div>                     
        <div class="form-group col-md-4">
            <lable>Address</lable>
    <input type="text" name="address" value="<?php echo $result->address;?>" class="form-control">
        </div>           
        <div class="form-group col-md-4">
            <lable>Fax #</lable>
    <input type="text" name="fax" value="<?php echo $result->fax;?>" class="form-control">
        </div>
        <div class="form-group col-md-8">
            <input type="submit" name="submit" value="Update" class="btn btn-theme">
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
 
 