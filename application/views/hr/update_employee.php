 <?php
        $emp_id = $result->emp_id;    
        $gender_id = $result->gender_id;
        $district_id = $result->district_id;
        $bg_id = $result->bg_id;
        $religion_id = $result->religion_id;
        $contract_type_id = $result->contract_type_id;
        $j_emp_scale_id = $result->j_emp_scale_id;
        $jdesg = $result->joining_designation;
        $cdesg = $result->current_designation;
        $cscale = $result->c_emp_scale_id;
        $country_id = $result->country_id;
        $shift_id = $result->shift_id;
        $subject_id = $result->subject_id;
        $category_id = $result->cat_id;
        $bank_id = $result->bank_id;
        $department_id = $result->department_id;
        $emp_status_id = $result->emp_status_id;
        $account_no = $result->account_no;
        $comment = $result->comment;
        $additional_responsibilty = $result->additional_responsibilty;
        $marital_status_id = $result->marital_status_id;
        $applicant_image = $result->picture;
        ?>
<!-- ******CONTENT****** --> 
        <div class="content container">
    <div class="row cols-wrapper">
        <div class="col-md-12">
    
            <?php
            if($applicant_image == "")
            {?>
    <img style="float:right; border-radius:10px;" src="<?php echo base_url();?>assets/images/employee/user.png" width="100" height="100">
            <?php
            }else
            {?>
    <img style="float:right; border-radius:10px;" src="<?php echo base_url();?>assets/images/employee/<?php echo $applicant_image;?>" width="100" height="100">
        <?php 
            }
            ?>
 <h2 align="left">Update Employee Profile (<?php echo $result->emp_name; ?>)<hr></h2>     
        </div>
    </div><br>
            <div class="row cols-wrapper">
                <div class="col-md-12">
    <form name="student" method="post" enctype="multipart/form-data" action="HrController/update_employee/<?php echo $emp_id;?>">       
<div class="form-group col-md-3">
    <label for="usr">Employee Name:</label>
    <input class="form-control" type="text" name="emp_name" value="<?php echo $result->emp_name; ?>" required>
    <input type="hidden" value="<?php echo $result->emp_id;?>" name="emp_id"> 
</div>
<div class="form-group col-md-3">
    <label for="usr">Father Name:</label>
    <input class="form-control" type="text" name="father_name" value="<?php echo $result->father_name; ?>">    
</div>                        
<div class="form-group col-md-3">
    <label for="usr">Husband Name:</label>
    <input class="form-control" type="text" name="emp_husband_name" value="<?php echo $result->emp_husband_name; ?>">    
</div>                        
<div class="form-group col-md-3">
    <label for="usr">Gender:</label>
    <select class="form-control" type="text" name="gender_id">
    <?php
$gres = $this->HrModel->get_by_id('gender',array('gender_id'=>$gender_id));
    if($gres){
        foreach($gres as $grec){ ?>                   
<option type="text" value="<?php echo $grec->gender_id;?>"><?php echo $grec->title;?></option>
     <?php 
        }     
    }else{
echo '<option type="text" value=""></option>';
        }    
    ?>
    <option>&larr; Select Gender &rarr;</option>
    <?php
    $g = $this->db->query("SELECT * FROM gender");
    foreach($g->result() as $grec)
    {
    ?>
    <option value="<?php echo $grec->gender_id;?>"><?php echo $grec->title;?></option>
    <?php 
    }
    ?>
</select>  
</div>                        
<div class="form-group col-md-3">
    <label for="usr">CNIC:</label>
    <input class="form-control nic" type="text" name="nic" id="emp_cnic" value="<?php echo $result->nic; ?>">    
</div>                            
<div class="form-group col-md-3">
    <label for="usr">Date of Birth:</label>
    <?php
        $ddate = $result->dob;
        if($ddate === '0000-00-00' || $ddate == '1970-01-01'){
            $ddate = '';
            } else {
            $ddate = date("d-m-Y", strtotime($ddate));
            }
    ?>
    <input class="form-control date_format_d_m_yy" type="text" name="dob" value="<?php echo $ddate; ?>">    
</div>                            
<div class="form-group col-md-3">
    <label for="usr">Postal Address:</label>
    <input class="form-control" type="text" name="postal_address" value="<?php echo $result->postal_address; ?>">    
</div>                            
<div class="form-group col-md-3">
    <label for="usr">Permanent Address::</label>
    <input class="form-control" type="text" name="permanent_address" value="<?php echo $result->permanent_address; ?>">    
</div>                            
<div class="form-group col-md-3">
    <label for="usr">District:</label>
    <select class="form-control" type="text" name="district_id">
     <?php
$res = $this->HrModel->get_by_id('district',array('district_id'=>$district_id));
    if($res){
        foreach($res as $drec){ ?>                   
<option type="text" value="<?php echo $drec->district_id;?>"><?php echo $drec->name;?></option>
     <?php 
        }     
    }else{
echo '<option type="text" value=""></option>';
        }    
    ?>
    <option>&larr; Select District &rarr;</option>
    <?php
    $d = $this->db->query("SELECT * FROM district");
    foreach($d->result() as $drec)
    {
    ?>
    <option value="<?php echo $drec->district_id;?>"><?php echo $drec->name;?></option>
    <?php 
    }
    ?>
</select>  
</div>
<div class="form-group col-md-3">
    <label for="usr">Post Office:</label>
    <input class="form-control" type="text" name="post_office" value="<?php echo $result->post_office; ?>">    
</div>        
<div class="form-group col-md-3">
    <label for="usr">Country:</label>
    <select class="form-control" type="text" name="country_id">
     <?php
$res = $this->HrModel->get_by_id('country',array('country_id'=>$country_id));
    if($res){
        foreach($res as $crec){ ?>                   
<option type="text" value="<?php echo $crec->country_id;?>"><?php echo $crec->name;?></option>
     <?php 
        }     
    }else{
echo '<option type="text" value=""></option>';
        }    
    ?>
    <option>&larr; Select Country &rarr;</option>
    <?php
    $c = $this->db->query("SELECT * FROM country");
    foreach($c->result() as $crec)
    {
    ?>
    <option value="<?php echo $crec->country_id;?>"><?php echo $crec->name;?></option>
    <?php 
    }
    ?>
</select>  
</div> 
<div class="form-group col-md-3">
    <label for="usr">Blood Group:</label>
    <select class="form-control" type="text" name="bg_id">
      <?php
$res = $this->HrModel->get_by_id('blood_group',array('b_group_id'=>$bg_id));
    if($res){
        foreach($res as $crec){ ?>                   
<option type="text" value="<?php echo $crec->b_group_id;?>"><?php echo $crec->title;?></option>
     <?php 
        }     
    }else{
echo '<option type="text" value=""></option>';
        }    
    ?>
    <option>&larr; Select Blood Group &rarr;</option>
    <?php
    $c = $this->db->query("SELECT * FROM blood_group");
    foreach($c->result() as $crec)
    {
    ?>
    <option value="<?php echo $crec->b_group_id;?>"><?php echo $crec->title;?></option>
    <?php 
    }
    ?>
</select>  
</div> 
<div class="form-group col-md-3">
    <label for="usr">PTCL number:</label>
    <input class="form-control" type="text" name="ptcl_number" value="<?php echo $result->ptcl_number; ?>">    
</div>
<div class="form-group col-md-3">
    <label for="usr">Mobile No 1</label>
    <input class="form-control phone" type="text" name="contact1" value="<?php echo $result->contact1; ?>">    
</div>
<div class="form-group col-md-3">
    <label for="usr">Mobile Network:</label>
    <select class="form-control" type="text" name="net_id">
     <?php
$res = $this->HrModel->get_by_id('mobile_network',array('net_id'=>$result->net_id));
    if($res){
        foreach($res as $drec){ ?>                   
<option type="text" value="<?php echo $drec->net_id;?>"><?php echo $drec->network;?></option>
     <?php 
        }     
    }else{
echo '<option type="text" value=""></option>';
        }    
    ?>
    <option>Select Mobile Network</option>
    <?php
    $mn = $this->CRUDModel->getResults("mobile_network");
        foreach($mn as $mrec)
        {
        ?>
            <option value="<?php echo $mrec->net_id;?>"><?php echo $mrec->network;?></option>
        <?php 
        }
    ?>
</select>  
</div>        
<div class="form-group col-md-3">
    <label for="usr">Mobile No 2</label>
    <input class="form-control phone" type="text" name="contact2" value="<?php echo $result->contact2; ?>">    
</div>
<div class="form-group col-md-3">
    <label for="usr">Religion:</label>
    <select class="form-control" type="text" name="religion_id">
     <?php
$res = $this->HrModel->get_by_id('religion',array('religion_id'=>$religion_id));
    if($res){
        foreach($res as $crec){ ?>                   
<option type="text" value="<?php echo $crec->religion_id;?>"><?php echo $crec->title;?></option>
     <?php 
        }     
    }else{
echo '<option type="text" value=""></option>';
        }    
    ?>
    <option>&larr; Select Religion &rarr;</option>
    <?php
    $c = $this->db->query("SELECT * FROM religion");
    foreach($c->result() as $crec)
    {
    ?>
    <option value="<?php echo $crec->religion_id;?>"><?php echo $crec->title;?></option>
    <?php 
    }
    ?>
</select>  
</div> 
<div class="form-group col-md-3">
    <label for="usr">Marital Status:</label>
    <select class="form-control" type="text" name="marital_status_id">
      <?php
$res = $this->HrModel->get_by_id('marital_status',array('marital_status_id'=>$marital_status_id));
    if($res){
        foreach($res as $grec){ ?>                   
<option type="text" value="<?php echo $grec->marital_status_id;?>"><?php echo $grec->title;?></option>
     <?php 
        }     
    }else{
echo '<option type="text" value=""></option>';
        }    
    ?>
    <option>&larr; Select Marital Status &rarr;</option>
    <?php
    $b = $this->db->query("SELECT * FROM marital_status");
    foreach($b->result() as $brec)
    {
    ?>
    <option value="<?php echo $brec->marital_status_id;?>"><?php echo $brec->title;?></option>
    <?php 
    }
    ?>
</select>  
</div>                           
<div class="form-group col-md-3">
    <label for="usr">Employee Personal No.:</label>
    <input class="form-control" type="text" name="emp_personal_no" value="<?php echo $result->emp_personal_no; ?>">    
</div>                        
<div class="form-group col-md-3">
    <label for="usr">GP Fund No.:</label>
    <input class="form-control" type="text" name="gp_fund_no" value="<?php echo $result->gp_fund_no; ?>">    
</div>                        
<div class="form-group col-md-3">
    <label for="usr">Employee email:</label>
    <input class="form-control" type="text" name="email" value="<?php echo $result->email; ?>">    
</div>                        
<div class="form-group col-md-3">
    <label for="usr">Contract:</label>
<select class="form-control" type="text" name="contract_type_id">
    <?php
$res = $this->HrModel->get_by_id('hr_emp_contract_type',array('contract_type_id'=>$contract_type_id));
    if($res){
        foreach($res as $grec){ ?>                   
<option type="text" value="<?php echo $grec->contract_type_id;?>"><?php echo $grec->title;?></option>
     <?php 
        }     
    }else{
echo '<option type="text" value=""></option>';
        }    
    ?>
    <option>&larr; Select Job Type &rarr;</option>
    <?php
    $b = $this->db->query("SELECT * FROM hr_emp_contract_type");
    foreach($b->result() as $brec)
    {
    ?>
    <option value="<?php echo $brec->contract_type_id;?>"><?php echo $brec->title;?></option>
    <?php 
    }
    ?>
</select> 
</div>
<div class="form-group col-md-3">
    <label for="usr">Joining Scale :</label>
<select class="form-control" type="text" name="j_emp_scale_id">
    <?php
$res = $this->HrModel->get_by_id('hr_emp_scale',array('emp_scale_id'=>$j_emp_scale_id));
    if($res){
        foreach($res as $jrec){ ?>                   
<option type="text" value="<?php echo $jrec->emp_scale_id;?>"><?php echo $jrec->title;?></option>
     <?php 
        }     
    }else{
echo '<option type="text" value=""></option>';
        }    
    ?>
    <option>&larr; Select Scale &rarr;</option>
    <?php
    $js = $this->db->query("SELECT * FROM hr_emp_scale");
    foreach($js->result() as $jsrec)
    {
    ?>
    <option value="<?php echo $jsrec->emp_scale_id;?>"><?php echo $jsrec->title;?></option>
    <?php 
    }
    ?>
</select> 
</div> 
<div class="form-group col-md-3">
    <label for="usr">Joining Designation :</label>
<select class="form-control" type="text" name="joining_designation">
     <?php
$res = $this->HrModel->get_by_id('hr_emp_designation',array('emp_desg_id'=>$jdesg));
    if($res){
        foreach($res as $jrec){ ?>                   
<option type="text" value="<?php echo $jrec->emp_desg_id;?>"><?php echo $jrec->title;?></option>
     <?php 
        }     
    }else{
echo '<option type="text" value=""></option>';
        }    
    ?>
    <option>&larr; Select Designation &rarr;</option>
    <?php
    $js = $this->db->query("SELECT * FROM hr_emp_designation");
    foreach($js->result() as $jsrec)
    {
    ?>
    <option value="<?php echo $jsrec->emp_desg_id;?>"><?php echo $jsrec->title;?></option>
    <?php 
    }
    ?>
</select> 
</div>    
 <div class="form-group col-md-3">
    <label for="usr">Joining Date:</label>
     <?php
        $jdate = $result->joining_date;
        if($jdate === '0000-00-00' || $jdate == '1970-01-01'){
            $jdate = '';
            } else {
            $jdate = date("d-m-Y", strtotime($jdate));
            }
    ?>
<input class="form-control date_format_d_m_yy" type="text" name="joining_date" value="<?php echo $jdate; ?>">    
</div>                     
 <div class="form-group col-md-3">
    <label for="usr">Current Scale :</label>
<select class="form-control" type="text" name="c_emp_scale_id">
    <?php
$res = $this->HrModel->get_by_id('hr_emp_scale',array('emp_scale_id'=>$cscale));
    if($res){
        foreach($res as $jrec){ ?>                   
<option type="text" value="<?php echo $jrec->emp_scale_id;?>"><?php echo $jrec->title;?></option>
     <?php 
        }     
    }else{
echo '<option type="text" value=""></option>';
        }    
    ?>
    <option>&larr; Select Scale &rarr;</option>
    <?php
    $js = $this->db->query("SELECT * FROM hr_emp_scale");
    foreach($js->result() as $jsrec)
    {
    ?>
    <option value="<?php echo $jsrec->emp_scale_id;?>"><?php echo $jsrec->title;?></option>
    <?php 
    }
    ?>
</select> 
</div>
<div class="form-group col-md-3">
    <label for="usr">Current Designation :</label>
<select class="form-control" type="text" name="current_designation">
     <?php
$res = $this->HrModel->get_by_id('hr_emp_designation',array('emp_desg_id'=>$cdesg));
    if($res){
        foreach($res as $jrec){ ?>                   
<option type="text" value="<?php echo $jrec->emp_desg_id;?>"><?php echo $jrec->title;?></option>
     <?php 
        }     
    }else{
echo '<option type="text" value=""></option>';
        }    
    ?>
    <option>&larr; Select Designation &rarr;</option>
    <?php
    $js = $this->db->query("SELECT * FROM hr_emp_designation ORDER BY title");
    foreach($js->result() as $jsrec)
    {
    ?>
    <option value="<?php echo $jsrec->emp_desg_id;?>"><?php echo $jsrec->title;?></option>
    <?php 
    }
    ?>
</select> 
</div>
<div class="form-group col-md-3">
    <label for="usr">Department:</label>
<select class="form-control" type="text" name="department_id">
    <?php
$res = $this->HrModel->get_by_id('department',array('department_id'=>$department_id));
    if($res){
        foreach($res as $jrec){ ?>                   
<option type="text" value="<?php echo $jrec->department_id;?>"><?php echo $jrec->title;?></option>
     <?php 
        }     
    }else{
echo '<option type="text" value=""></option>';
        }    
    ?>
    <option>&larr; Select Department &rarr;</option>
    <?php
    $js = $this->db->query("SELECT * FROM department");
    foreach($js->result() as $jsrec)
    {
    ?>
    <option value="<?php echo $jsrec->department_id;?>"><?php echo $jsrec->title;?></option>
    <?php 
    }
    ?>
</select> 
</div>
<div class="form-group col-md-3">
    <label for="usr">Subject:</label>
<select class="form-control" type="text" name="subject_id">
   <?php
$res = $this->HrModel->get_by_id('subject',array('subject_id'=>$subject_id));
    if($res){
        foreach($res as $jrec){ ?>                   
<option type="text" value="<?php echo $jrec->subject_id;?>"><?php echo $jrec->title;?></option>
     <?php 
        }     
    }else{
echo '<option type="text" value=""></option>';
        }    
    ?>
    <option>&larr; Subject Speciality &rarr;</option>
    <?php
    $js = $this->db->query("SELECT * FROM subject");
    foreach($js->result() as $jsrec)
    {
    ?>
    <option value="<?php echo $jsrec->subject_id;?>"><?php echo $jsrec->title;?></option>
    <?php 
    }
    ?>
</select> 
</div>
<div class="form-group col-md-3">
    <label for="usr">Shift:</label>
<select class="form-control" type="text" name="shift_id">
    <?php
$res = $this->HrModel->get_by_id('shift',array('shift_id'=>$shift_id));
    if($res){
        foreach($res as $jrec){ ?>                   
<option type="text" value="<?php echo $jrec->shift_id;?>"><?php echo $jrec->name;?></option>
     <?php 
        }     
    }else{
echo '<option type="text" value=""></option>';
        }    
    ?>
    <option>&larr; Select Shift &rarr;</option>
    <?php
    $js = $this->db->query("SELECT * FROM shift");
    foreach($js->result() as $jsrec)
    {
    ?>
    <option value="<?php echo $jsrec->shift_id;?>"><?php echo $jsrec->name;?></option>
    <?php 
    }
    ?>
</select> 
</div>
<div class="form-group col-md-3">
    <label for="usr">Bank:</label>
<select class="form-control" type="text" name="bank_id">
  <?php
$res = $this->HrModel->get_by_id('bank',array('bank_id'=>$bank_id));
    if($res){
        foreach($res as $jrec){ ?>                   
<option type="text" value="<?php echo $jrec->bank_id;?>"><?php echo $jrec->name;?></option>
     <?php 
        }     
    }else{
echo '<option type="text" value=""></option>';
        }    
    ?>
    <option>&larr; Bank Name &rarr;</option>
    <?php
    $js = $this->db->query("SELECT * FROM bank");
    foreach($js->result() as $jsrec)
    {
    ?>
    <option value="<?php echo $jsrec->bank_id;?>"><?php echo $jsrec->name;?></option>
    <?php 
    }
    ?>
</select> 
</div>
<div class="form-group col-md-3">
    <label for="usr">Account No.:</label>        
<input type="text" name="account_no" class="form-control" value="<?php echo $account_no; ?>">                          
</div>
<div class="form-group col-md-3">
    <label for="usr">Employee Status:</label>
<select class="form-control" type="text" name="emp_status_id">
  <?php
$res = $this->HrModel->get_by_id('hr_emp_status',array('emp_status_id'=>$emp_status_id));
    if($res){
        foreach($res as $jrec){ ?>                   
<option type="text" value="<?php echo $jrec->emp_status_id;?>"><?php echo $jrec->title;?></option>
     <?php 
        }     
    }else{
echo '<option type="text" value=""></option>';
        }    
    ?>
    <option>&larr; Employee Status &rarr;</option>
    <?php
    $js = $this->db->query("SELECT * FROM hr_emp_status");
    foreach($js->result() as $jsrec)
    {
    ?>
    <option value="<?php echo $jsrec->emp_status_id;?>"><?php echo $jsrec->title;?></option>
    <?php 
    }
    ?>
</select> 
</div>  
<div class="form-group col-md-3">
    <label for="usr">Comment:</label>        
<input type="text" name="comment" class="form-control" value="<?php echo $comment; ?>">                   </div>
<div class="form-group col-md-6">
  <label for="usr">Additional Responsibilty:</label>
  <input type="text" name="additional_responsibilty" value="<?php echo $additional_responsibilty; ?>" class="form-control"> 
</div>        
<div class="form-group col-md-3">
    <label for="usr">Employee Category:</label>
<select class="form-control" type="text" name="cat_id">
  <?php
$res = $this->HrModel->get_by_id('hr_emp_category',array('cat_id'=>$category_id));
    if($res){
        foreach($res as $jrec){ ?>                   
<option type="text" value="<?php echo $jrec->cat_id;?>"><?php echo $jrec->title;?></option>
     <?php 
        }     
    }else{
echo '<option type="text" value=""></option>';
        }    
    ?>
    <option>&larr; Employee Category &rarr;</option>
    <?php
    $js = $this->db->query("SELECT * FROM hr_emp_category");
    foreach($js->result() as $jsrec)
    {
    ?>
    <option value="<?php echo $jsrec->cat_id;?>"><?php echo $jsrec->title;?></option>
    <?php 
    }
    ?>
</select> 
        </div>
    <div class="form-group col-md-3">
    <label for="usr">Retirement Date:</label>
            <?php
        $rdate = $result->retirement_date;
            if($rdate === '0000-00-00' || $rdate == '1970-01-01'){
            $rdate = '';
            } else {
            $rdate = date("d-m-Y", strtotime($rdate));
            }
                        ?>
            <input class="form-control date_format_d_m_yy" type="text" name="retirement_date" value="<?php echo $rdate; ?>">    
    </div>
    <div class="form-group col-md-3">
    <label for="usr">HoD Flag</label>
        <select class="form-control" type="text" name="hod_ms_flag">
        <option value="0" <?php if($result->hod_ms_flag == '0') {echo 'selected';}?> >No</option>        
        <option value="1" <?php if($result->hod_ms_flag == '1') {echo 'selected';}?>>Yes</option>        
        
    </select>
             
    </div>
 
      <div class="form-group col-md-3">
      <label for="usr" style="visibility:hidden">HoD Flag sdfasd</label>
            <input style="margin-left:30px;" type="submit" class="btn btn-primary" name="submit" value="Update Employee">
      </div>                      
                        </div>
                    </div>
                </form> 
        <br>
        <br>
<h3 align="center">
    <span style="left:right">
    <a href="HrController/employee_academic_record/<?php echo $emp_id;?>" class="btn btn-large btn-primary">Add Academic Record</a></span>
    <span style="folat:left">
    <a href="HrController/add_research_paper/<?php echo $emp_id;?>" class="btn btn-large btn-theme">Add Research Paper</a></span>
    <span style="folat:left">
    <a href="HrController/add_professional_education/<?php echo $emp_id;?>" class="btn btn-large btn-danger">Professional Education</a></span>
    <span style="folat:left">
    <a href="HrController/grant_in_aid/<?php echo $emp_id;?>" class="btn btn-large btn-success">Grant in Add</a></span>
</h3>

             
    <div class="courses-wrapper col-md-12 col-sm-7">           
                <div class="featured-courses tabbed-info page-row">             
                    <ul class="nav nav-tabs">
                      <li class="active"><a href="#tab1" data-toggle="tab" aria-expanded="true"><strong style="font-size:16px;">Academic Record</strong></a></li>
                      <li class=""><a href="#tab2" data-toggle="tab" aria-expanded="false"><strong style="font-size:16px;">Research Paper</strong></a></li>
                      <li class=""><a href="#tab3" data-toggle="tab" aria-expanded="false"><strong style="font-size:16px;">Add Professional Education</strong></a></li>
                    <li class=""><a href="#tab4" data-toggle="tab" aria-expanded="false"><strong style="font-size:16px;">GRANT-IN-AID</strong></a></li>    
                    </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="tab1">
                      <div class="row">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Serial No</th>
                            <th>Degree</th>
                            <th>Board/University</th>
                             <th>Passing Year</th>
                             <th>CGPA</th>
                            <th>Division</th>
                            <th>Hec Verified</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        if($employee_records):
                        foreach($employee_records as $eRow):
                       echo '<tr>';
                            echo '<td>'.$i.'</td>';
                            echo '<td>'.$eRow->Degreetitle.'</td>';
                            echo '<td>'.$eRow->bordTitle.'</td>';
                            echo '<td>'.$eRow->passing_year.'</td>';
                            echo '<td>'.$eRow->cgpa.'</td>';
                            echo '<td>'.$eRow->divisiontitle.'</td>';
                            echo '<td>'.$eRow->hec_verified.'</td>';
                            echo '<td><a href="HrController/update_emp_edu/'.$eRow->emp_edu_id.'/'.$emp_id.'">Update</a></td>';
                            echo '<td><a href="HrController/delete_emp_edu/'.$eRow->emp_edu_id.'/'.$emp_id.'">Delete</td>';
                       echo '</tr>';
                        $i++;
                        endforeach;
                        endif;
                        ?>
                    </tbody>
                </table>
                  </div><!--//row-->
              </div>
        <div class="tab-pane" id="tab2">
              <div class="row">
                 <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Author Name</th>
                            <th>Title</th>
                            <th>Journal</th>
                            <th>Date</th>
                            <th>Year</th>
                            <th>View Detail</th>
                            <th>Update</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($research):
                      //  echo '<pre>';print_r($research);die;
                        foreach($research as $empRow):
                            $date = $empRow->date;
                            $newDate = date("d-m-Y", strtotime($date));
                           echo '<tr>';
                                echo '<td>'.$empRow->author.'</td>';
                                echo '<td>'.$empRow->title.'</td>';
                                echo '<td>'.$empRow->journal.'</td>';
                                echo '<td>'.$newDate.'</td>';
                                echo '<td>'.$empRow->year.'</td>';
                                echo '<td><a href="HrController/view_research_paper/'.$empRow->rp_id.'">View Detail</a></td>';
                                echo '<td><a href="HrController/update_research_paper/'.$empRow->rp_id.'">Update</a></td>';
                                echo '<td><a href="HrController/delete_research_paper/'.$empRow->rp_id.'">Delete</td>';
                           echo '</tr>';
                        endforeach;
                        endif;
                        ?>
                    </tbody>
                </table> 
              </div><!--//row-->
          </div>
          <div class="tab-pane" id="tab3">
              <div class="row">
                 <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Affiliated Institute</th>
                            <th>Date</th>
                            <th>Year</th>
                            <th>View Detail</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($professional):
                      //  echo '<pre>';print_r($research);die;
                        foreach($professional as $prof):
                            $date = $prof->date;
                            $newDate = date("d-m-Y", strtotime($date));
                           echo '<tr>';
                                echo '<td>'.$prof->title.'</td>';
                                echo '<td>'.$prof->aff_institute.'</td>';
                                echo '<td>'.$newDate.'</td>';
                                echo '<td>'.$prof->duration.'</td>';
                                echo '<td><a href="HrController/view_professional_edu/'.$prof->fe_id.'">View Detail</a></td>';
                                echo '<td><a href="HrController/update_professional_edu/'.$prof->fe_id.'">Update</a></td>';
                                echo '<td><a href="HrController/delete_professional_edu/'.$prof->fe_id.'">Delete</td>';
                           echo '</tr>';
                        endforeach;
                        endif;
                        ?>
                    </tbody>
                </table> 
                  </div><!--//row-->
              </div>
               <div class="tab-pane" id="tab4">
              <div class="row">
                 <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>File #</th>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Allowance for</th>
                             <th>Start Date</th>
                             <th>Completion Date</th>
                            <th>Amount Received</th>
                            <th>Amount Coll Date</th>
                            <th>Status</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if($employee_grant):
                        foreach($employee_grant as $empRow): 
                            if($empRow->start_date === '0000-00-00' || $empRow->start_date == '1970-01-01' || $empRow->start_date == ''):
                            echo $date1 = '';
                        else:
                            $date1 = date("d-m-Y", strtotime($empRow->start_date));
                         endif;
                        if($empRow->end_date === '0000-00-00' || $empRow->end_date == '1970-01-01' || $empRow->end_date == ''):
                            echo $date2 = '';
                        else:
                            $date2 = date("d-m-Y", strtotime($empRow->end_date));
                         endif;
                        if($empRow->amount_coll_date === '0000-00-00' || $empRow->amount_coll_date == '1970-01-01' || $empRow->amount_coll_date == ''):
                            echo $date3 = '';
                        else:
                            $date3 = date("d-m-Y", strtotime($empRow->amount_coll_date));
                         endif;
                           echo '<tr>';
                                echo '<td>'.$empRow->file_no.'</td>';
                                echo '<td>'.$empRow->emp_name.'</td>';
                                echo '<td>'.$empRow->dept.'</td>';
                                echo '<td>'.$empRow->degree.'</td>';
                                echo '<td>'.$date1.'</td>';
                                echo '<td>'.$date2.'</td>';
                                echo '<td>'.$empRow->amount_received.'</td>';
                                echo '<td>'.$date3.'</td>';
                                echo '<td>'.$empRow->status_title.'</td>';
                                echo '<td><a href="HrController/update_grant_in_aid/'.$empRow->grant_id.'/'.$empRow->emp_id.'">Update</a></td>';
                                echo '<td><a href="HrController/delete_grant_in_aid/'.$empRow->grant_id.'/'.$empRow->emp_id.'">Delete</td>';
                           echo '</tr>';
                        endforeach;
                        endif;
                        ?>
                    </tbody>
                </table> 
                  </div><!--//row-->
              </div>        
            </div>
        </div><!--//featured-courses-->

        </div>
        
 
</div>