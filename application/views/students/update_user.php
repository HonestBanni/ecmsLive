<div class="grid-form">
    <div class="grid-form1">
 		<h2 id="forms-example" class="">Change Password</h2>
 		<form method="post" action="StudentController/update_password">
            <div class="form-group col-md-6">
            <label for="exampleInputEmail1">College Number</label>
            <input type="email" class="form-control" id="exampleInputEmail1" value="<?php echo $result->college_no;?>" readonly>
          </div>
          <div class="form-group col-md-6">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" name="password" value="<?php echo $result->student_password;?>">
          </div>
		<div class="row">
			<div class="col-sm-8 col-offset-2">
				<input type="submit" name="submit" class="btn-primary btn">
			</div>
	 </div>        
</form>
    </div>
</div>    